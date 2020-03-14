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

//Route::get('/', function() {
//    return view('welcome');
//});
Route::get('orders/{order}', 'OrdersController@show')->name('orders.show');
Route::get('payments/{order}/alipay', 'PaymentsController@alipay')->name('payments.alipay');
Route::get('payments/alipay/return', 'PaymentsController@alipayReturn')->name('payments.alipay.return');
Route::post('payments/alipay/notify', 'PaymentsController@alipayNotify')->name('payments.alipay.notify');
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
