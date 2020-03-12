<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\User;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $verifyCode = \Cache::get($request->verification_key);
        if(!$verifyCode) {
            abort(403, '验证码已失效');
        }
        if(!hash_equals($verifyData['code'], $request->verification_code)) {
            // 返回401
            throw new AuthenticationException('验证码错误');
        }
        $user = new User([
            'username' => $request->username,
            'phone' => $verifyData['phone'],
            'password' => $request->password,

        ]);
        // 清除验证码缓存
        \Cache::forget($request->verification_key);
        return new UserResource($user);
    }
}
