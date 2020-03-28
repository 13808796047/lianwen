<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use DefaultDatetimeFormat;
    const COMMON_USER_TYPE = 0;
    const COMMON_AGENT_TYPE = 1;
    const SENIOR_AGENT_TYPE = 2;
    public static $userType = [
        self::COMMON_USER_TYPE => '普通用户',
        self::COMMON_AGENT_TYPE => '普通代理',
        self::SENIOR_AGENT_TYPE => '高级代理',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'userid');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'phone', 'email', 'password', 'weixin_openid', 'weixin_unionid', 'nick_name', 'avatar', 'user_group', 'consumption_amount'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
