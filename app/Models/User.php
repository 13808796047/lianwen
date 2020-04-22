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
    const VIP_USER_TYPE = 3;
    public static $userType = [
        self::COMMON_USER_TYPE => '普通用户',
        self::COMMON_AGENT_TYPE => '普通代理',
        self::SENIOR_AGENT_TYPE => '高级代理',
        self::VIP_USER_TYPE => 'VIP用户',
    ];

    //权限控制
    public function isAuthOf($model)
    {
        return $this->id == $model->userid;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'custom_prices')->withPivot('price');
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
        'username', 'phone', 'email', 'password', 'weixin_openid', 'weixin_unionid', 'weapp_openid', 'weixin_session_key', 'nick_name', 'avatar', 'user_group', 'consumption_amount'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'weixin_openid', 'weixin_unionid', 'weapp_openid', 'weixin_session_key'
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
