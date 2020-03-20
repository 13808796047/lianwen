<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//微信登录
Route::get('/auth/{social}', 'AuthenticationController@SocialRedirect')
    ->middleware('guest');

Route::get('/auth/{social}/callback', 'AuthenticationController@SocialCallback')
    ->middleware('guest');

Route::get('/', 'PagesController@index')->name('pages.index');
Route::any('orders/{order?}', 'OrdersController@show')->name('orders.show');


//下载
Route::get('orders/{order}/download', 'OrdersController@download')
    ->name('orders.download');

//支付宝
Route::get('payments/{order}/alipay', 'PaymentsController@alipay')
    ->name('payments.alipay');
Route::get('payments/alipay/return', 'PaymentsController@alipayReturn')
    ->name('payments.alipay.return');
Route::post('payments/alipay/notify', 'PaymentsController@alipayNotify')
    ->name('payments.alipay.notify');
//微信
Route::get('payments/{order}/wechat', 'PaymentsController@wechatPay')
    ->name('payments.wechat');
Route::post('payments/wechat/notify', 'PaymentsController@wechatNotify')
    ->name('payments.wechat.notify');


//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
