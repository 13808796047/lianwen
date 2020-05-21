<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BoundPhoneRequest;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(UserRequest $request)
    {
        if($verification_key = $request->verification_key) {
            $verifyData = \Cache::get($verification_key);
            if(!$verifyData) {
                abort(403, '验证码已失效');
            }
            if(!hash_equals($verifyData['code'], $request->verification_code)) {
                // 返回401
                throw new AuthenticationException('验证码错误');
            }
            $phone = $verifyData['phone'];
        } else {
            $phone = $request->phone;
        }

        $user = User::create([
            'phone' => $phone,
            'password' => Hash::make($request->password),
        ]);
        // 清除验证码缓存
        \Cache::forget($verification_key);
        return new UserResource($user);
    }

    public function me(Request $request)
    {
        return (new UserResource($request->user))->showSensitiveFields();
    }

    public function boundPhone(BoundPhoneRequest $request)
    {
        $verification_key = $request->verification_key;
        if(!$verification_key) {
            throw new AuthenticationException('验证码错误!');
        }

        $verifyData = \Cache::get($verification_key);
        if(!$verifyData) {
            abort(403, '验证码已失效');
        }
        if(!hash_equals($verifyData['code'], $request->verification_code)) {
            // 返回401
            throw new AuthenticationException('验证码错误');
        }
        $phone = $verifyData['phone'];
        $this->userService->miniprogramBindPhone($phone);
        // 清除验证码缓存
        \Cache::forget($verification_key);
        return response([
            'message' => '绑定成功!'
        ], 200);
    }

    public function officalBoundPhone(BoundPhoneRequest $request)
    {
        //查询该手机号是否已经存在用户
        if(!$openid = $request->openid) {
            throw new AuthenticationException('参数错误!');
        }
        $verification_key = $request->verification_key;
        if(!$verification_key) {
            throw new AuthenticationException('验证码错误!');
        }

        $verifyData = \Cache::get($verification_key);
        if(!$verifyData) {
            abort(403, '验证码已失效');
        }
        if(!hash_equals($verifyData['code'], $request->verification_code)) {
            // 返回401
            throw new AuthenticationException('验证码错误');
        }
        $phone = $verifyData['phone'];
        $this->userService->officalBindPhone($openid, $phone);
        // 清除验证码缓存
        \Cache::forget($verification_key);
        return response([
            'message' => '绑定成功!'
        ], 200);
    }
}
