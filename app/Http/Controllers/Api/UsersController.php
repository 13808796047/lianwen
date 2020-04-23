<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
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

    public function boundPhone(Request $request)
    {
        //查询该手机号是否已经存在用户
        $user = User::where('phone', $request->phone)->first();
        $loginUser = $request->user();
        //不存在
        if(!$user) {
            //更新登录用户的手机号码
            $loginUser->update([
                'phone' => $request->phone,
            ]);
        } else {
            $loginUser->delete();
            $user->update([
                'phone' => $request->phone,
                'weapp_openid' => $loginUser->weapp_openid,
                'weapp_session_key' => $loginUser->weapp_session_key
            ]);
            $loginUser->orders->update([
                'userid' => $user->id,
            ]);
        }
        return response([
            'message' => '绑定成功!'
        ], 200);
    }
}
