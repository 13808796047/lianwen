<?php

namespace App\Providers;

use App\Handlers\BaiduPayHandler;
use EasyWeChat\Factory;
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
            $domain = request()->getHost();
            switch ($domain) {
                case 'wanfang.lianwen.com':
                    $config = config('pay.wanfang_alipay');
                    break;
                default:
                    $config = config('pay.alipay');
                    break;
            }
            $config['notify_url'] = route('payments.alipay.notify');
            $config['return_url'] = route('payments.alipay.return');
            //判断当前项目运行环境是否为线上环境
//            if(app()->environment() != 'production') {
//                $config['mode'] = 'dev';
////                $config['log']['level'] = Logger::DEBUG;
//            } else {
////                $config['log']['level'] = Logger::DEBUG;
//            }
            //调用yansongda/pay来创建一个支付宝对象
            return Pay::alipay($config);
        });
        //往服务容器中注入一个名为alipay的单例对象
        $this->app->singleton('alipay_wap', function() {
            $config = config('pay.alipay');
            $config['notify_url'] = route('payments.alipay.notify');
            $domain = request()->getHost();
            switch ($domain) {
                case 'dev.lianwen.com':
                    $config['return_url'] = 'https://wap.lianwen.com/wanfang/#/report';
                    break;
                case "www.zcnki.com":
                    $config['return_url'] = 'https://wap.lianwen.com/weipu/#/report';
                    break;
            }
            //判断当前项目运行环境是否为线上环境
//            if(app()->environment() != 'production') {
//                $config['mode'] = 'dev';
////                $config['log']['level'] = Logger::DEBUG;
//            } else {
////                $config['log']['level'] = Logger::DEBUG;
//            }
            //调用yansongda/pay来创建一个支付宝对象
            return Pay::alipay($config);
        });
        //微信支付容器
        $this->app->singleton('wechat_pay', function() {
            $domain = request()->getHost();
            switch ($domain) {
                case 'wanfang.lianwen.com':
                    $config = config('pay.wanfang_wechat');
                    break;
                default:
                    $config = config('pay.wechat');
                    break;
            }
            $config['notify_url'] = route('payments.wechat.notify');
//            if(app()->environment() !== 'production') {
//                $config['log']['level'] = Logger::DEBUG;
//            } else {
////                $config['log']['level'] = Logger::DEBUG;
//            }
            //调用Yansongda/pay来创建一个微信支付对象
            return Pay::wechat($config);
        });
        //h5
        //微信支付容器
        $this->app->singleton('wechat_pay_wap', function() {
            $config = config('pay.wechat');
            $config['notify_url'] = route('payments.wechat.notify');
            return Pay::wechat($config);
        });
        $this->app->singleton('wechat_pay_mp', function() {
            $domain = request()->getHost();
            switch ($domain) {
                case 'mp.cnweipu.com':
                    $config = config('pay.dev_wechat');
                    break;
                default:
                    $config = config('pay.dev_wechat');
                    break;
            }
            //$config = config('pay.wechat');
            $config['notify_url'] = route('payments.wechat.notify');
//            if(app()->environment() !== 'production') {
//                $config['log']['level'] = Logger::DEBUG;
//            } else {
//                $config['log']['level'] = Logger::DEBUG;
//            }
            //调用Yansongda/pay来创建一个微信支付对象
            return Pay::wechat($config);
        });
        //百度收银台
        $this->app->singleton('baidu_pay', function() {
            $domain = request()->getHost();
            switch ($domain) {
                case 'dev.lianwen.com':
                    $config = config('pay.dev_baidu_pay');
                    break;
                default:
                    $config = config('pay.zcnki_baidu_pay');
                    break;
            }
            return new BaiduPayHandler($config);
        });
        //公众号
        $this->app->singleton('official_account', function() {
            $domain = \request()->getHost();
            switch ($domain) {
                case 'mp.cnweipu.com':
                    $config = config('wechat.official_account.default');
                    break;
                default:
                    $config = config('wechat.official_account.default');
            }
            return Factory::officialAccount($config);
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
        view()->composer('domained::layouts._header', function($view) {
            $categories = DB::table('categories')->where('status', 1)->distinct()->select(['classname', 'classid'])->get();
            $view->with('categories', $categories);
        });
    }
}
