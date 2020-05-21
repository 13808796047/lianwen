<?php


namespace App\Services;


use App\Exceptions\InvalidRequestException;
use App\Models\User;

class UserService
{
    public function officalBindPhone($openid, $phone)
    {
        $bindUser = User::query()->where('weixin_openid', $openid)->first();
        $phoneUser = User::where('phone', $phone)->first();
        if($bindUser->phone) {
            throw new InvalidRequestException('你已经绑定过手机了!', 500);
        }
        if(!$phoneUser) {
            $bindUser->phone = $phone;
            $bindUser->save();
        }
        $phone_user->delete();
        $bindUser->update([
            'phone' => $phone,
            'password' => $phone_user->password ?? ""
        ]);
        foreach($phone_user->orders as $order) {
            $order->update([
                'userid' => $bindUser->id,
            ]);
        }
    }

    public function miniprogramBindPhone($phone)
    {
        $mini_program_user = auth()->user();
        $phone_user = User::where('phone', $phone)->first();
        //不存在
        if(!$phone_user) {
            //更新登录用户的手机号码
            if(!$mini_program_user->phone) {
                $mini_program_user->update([
                    'phone' => $phone,
                ]);
            }
        } else {
            $phone_user->delete();
            if(!$mini_program_user->phone) {
                $mini_program_user->update([
                    'phone' => $phone,
                    'password' => $phone_user->password ?? ""
                ]);
            }
            if(!$mini_program_user->weixin_openid && !$mini_program_user->weixin_unionid) {
                $mini_program_user->update([
                    'weixin_openid' => $phone_user->weixin_openid,
                    'weixin_unionid' => $phone_user->weixin_unionid,
                ]);
            }
            foreach($phone_user->orders as $order) {
                $order->update([
                    'userid' => $mini_program_user->id,
                ]);
            }
        }
    }
}
