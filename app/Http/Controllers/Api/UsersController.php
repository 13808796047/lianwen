<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BoundPhoneRequest;
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
        //查询该手机号是否已经存在用户
        $mini_program_user = $request->user();
        $phone_user = User::where('phone', $phone)->first();
        $weixin_user = User::where('weixin_unionid', $mini_program_user->weixin_session_key)->first();
        //不存在
        if(!$phone_user || !$weixin_user) {
            //更新登录用户的手机号码
            $mini_program_user->update([
                'phone' => $phone,
            ]);
        }
        if($phone_user) {
            $phone_user->delete();
            $mini_program_user->update([
                'phone' => $phone,
                'password' => $phone_user->password ?? ""
            ]);
            foreach($phone_user->orders as $order) {
                $order->update([
                    'userid' => $mini_program_user->id,
                ]);
            }
        }
        if($weixin_user) {
            $weixin_user->delete();
            $mini_program_user->update([
                'weixin_openid' => $weixin_user->weixin_openid,
                'weixin_unionid' => $weixin_user->weixin_unionid,
            ]);
            foreach($weixin_user->orders as $order) {
                $order->update([
                    'userid' => $mini_program_user->id,
                ]);
            }
        }
        // 清除验证码缓存
        \Cache::forget($verification_key);
        return response([
            'message' => '绑定成功!'
        ], 200);
    }
}
