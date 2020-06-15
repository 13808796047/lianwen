<?php


namespace App\Services;


use App\Exceptions\InvalidRequestException;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        $phoneUser->delete();
        $bindUser->update([
            'phone' => $phone,
            'password' => $phoneUser->password ?? ""
        ]);
        foreach($phoneUser->orders as $order) {
            $order->update([
                'userid' => $bindUser->id,
            ]);
        }
    }

    public function miniprogramBindPhone($request, $phone)
    {
        $mini_program_user = auth()->user();
        $phone_user = User::where('phone', $phone)->first();
        $mini_program_user = DB::transaction(function() use ($request, $mini_program_user, $phone_user, $phone) {
//            if(!$phone_user) {
//                $mini_program_user->update([
//                    'phone' => $phone,
//                ]);
//            }
            $mini_program_user->update([
                'phone' => $phone,
                'password' => $phone_user->password ?? "",
            ]);
//            $data = [
//                'weixin_unionid' => $phone_user->weixin_unionid,
//            ];
//
//            if($phone_user->weixin_unionid) {
//                switch (request()->getHost()) {
//                    case config('app.host.dev_host'):
//                        $data['dev_weapp_openid'] = $phone_user->dev_weapp_openid;
//                        break;
//                    case config('app.host.wf_host'):
//                        $data['wf_weapp_openid'] = $phone_user->wf_weapp_openid;
//                        break;
//                    case config('app.host.wp_host'):
//                        $data['wp_weapp_openid'] = $phone_user->wp_weapp_openid;
//                        break;
//                    case config('app.host.pp_host'):
//                        $data['pp_weapp_openid'] = $phone_user->pp_weapp_openid;
//                        break;
//                    default:
//                        $data['cn_weapp_openid'] = $phone_user->cn_weapp_openid;
//                }
//                $mini_program_user->update($data);
//            }
            foreach($phone_user->orders as $order) {
                $order->update([
                    'userid' => $mini_program_user->id,
                ]);
            }
            $phone_user->delete();
            return $mini_program_user;
        });
        return $mini_program_user;
    }
}
