<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/oauth/{type}', 'AuthenticationsController@oauth')->name('oauth');
Route::get('/oauth/{type}/callback', 'AuthenticationsController@callback');


Route::get('/', 'PagesController@index')->name('pages.index');

Route::group(['middleware' => 'auth'], function() {
    Route::get('categories/{classid}', 'CategoriesController@show')->name('categories.show');
    Route::get('orders', 'OrdersController@index')->name('orders.index');
    Route::post('orders', 'OrdersController@store')->name('orders.store');
    Route::get('orders/{order}', 'OrdersController@show')->name('orders.show');
    Route::get('orders/{order}/view-report', 'OrdersController@viewReport')->name('orders.view-report');
    Route::delete('orders', 'OrdersController@destroy')->name('orders.destroy');
    // 公众号关注
    Route::get('official_account', 'OfficialAccountController@index')->name('official_account.index');

});

//下载
Route::get('orders/{orderid}/download', 'OrdersController@download')
    ->name('orders.download');

//自动查重
Route::get('auto_check', 'AutoCheckController@index')->name('auto.check.index');
Route::post('auto_check', 'AutoCheckController@store')->name('auto.check.store');
//支付宝
Route::get('payments/{order}/alipay', 'PaymentsController@alipay')
    ->name('payments.alipay');
Route::get('payments/{order}/alipay_wap', 'PaymentsController@alipayWap')
    ->name('payments.alipay_wap');
Route::get('payments/alipay/return', 'PaymentsController@alipayReturn')
    ->name('payments.alipay.return');
Route::post('payments/alipay/notify', 'PaymentsController@alipayNotify')
    ->name('payments.alipay.notify');
//微信
Route::get('payments/{order}/wechat', 'PaymentsController@wechatPay')
    ->name('payments.wechat');
Route::get('payments/{order}/wechat_wap', 'PaymentsController@wechatPayWap')
    ->name('payments.wechat_wap');
Route::get('payments/{order}/wechat_mp', 'PaymentsController@wechatPayMp')
    ->name('payments.wechat_mp');
Route::post('payments/wechat/notify', 'PaymentsController@wechatNotify')
    ->name('payments.wechat.notify');
Route::post('payments/wechat/mp_notify', 'PaymentsController@wechatMpNotify')
    ->name('payments.wechat.mp_notify');
Route::get('payments/{order}/return', 'PaymentsController@wechatReturn')->name('payments.wechat.return');
Auth::routes();
//百度支付
Route::post('payments/baidu/notify', 'PaymentsController@baiduNotify')->name('payments.baidu.notify');
Route::any('official_account/serve', 'OfficialAccountController@serve')->name('official_account.serve');
