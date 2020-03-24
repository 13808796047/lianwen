<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Monolog\Logger;
use Yansongda\Pay\Pay;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //往服务容器中注入一个名为alipay的单例对象
        $this->app->singleton('alipay', function() {
            $config = config('pay.alipay');
            $config['notify_url'] = route('payments.alipay.notify');
            $config['return_url'] = route('payments.alipay.return');
            //判断当前项目运行环境是否为线上环境
            if(app()->environment() != 'production') {
                $config['mode'] = 'dev';
                $config['log']['level'] = Logger::DEBUG;
            } else {
                $config['log']['level'] = Logger::DEBUG;
            }
            //调用yansongda/pay来创建一个支付宝对象
            return Pay::alipay($config);
        });
        //往服务容器中注入一个名为alipay的单例对象
        $this->app->singleton('alipay_wap', function() {
            $config = config('pay.alipay');
            $config['notify_url'] = route('payments.alipay.notify');
            $config['return_url'] = 'http://h5.lianwen.com/#/payment';
            //判断当前项目运行环境是否为线上环境
            if(app()->environment() != 'production') {
                $config['mode'] = 'dev';
                $config['log']['level'] = Logger::DEBUG;
            } else {
                $config['log']['level'] = Logger::DEBUG;
            }
            //调用yansongda/pay来创建一个支付宝对象
            return Pay::alipay($config);
        });
        //微信支付容器
        $this->app->singleton('wechat_pay', function() {
            $config = config('pay.wechat');
            $config['notify_url'] = route('payments.wechat.notify');
            if(app()->environment() !== 'production') {
                $config['log']['level'] = Logger::DEBUG;
            } else {
                $config['log']['level'] = Logger::DEBUG;
            }
            //调用Yansongda/pay来创建一个微信支付对象
            return Pay::wechat($config);
        });
        //h5
        //微信支付容器
        $this->app->singleton('wechat_pay_wap', function() {
            $config = config('pay.wechat');
            $config['notify_url'] = route('payments.wechat.notify');
            if(app()->environment() !== 'production') {
                $config['log']['level'] = Logger::DEBUG;
            } else {
                $config['log']['level'] = Logger::DEBUG;
            }
            //调用Yansongda/pay来创建一个微信支付对象
            return Pay::wechat($config);
        });
        $this->app->singleton('wechat_pay_mp', function() {
            $config = config('pay.wechat');
            $config['notify_url'] = route('payments.wechat.notify');
            if(app()->environment() !== 'production') {
                $config['log']['level'] = Logger::DEBUG;
            } else {
                $config['log']['level'] = Logger::DEBUG;
            }
            //调用Yansongda/pay来创建一个微信支付对象
            return Pay::wechat($config);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('layouts._header', function($view) {
            $categories = DB::table('categories')->where('status', 1)->distinct()->select(['classname', 'classid'])->get();
            $view->with('categories', $categories);
        });
    }
}
