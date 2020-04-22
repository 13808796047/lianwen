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
}
