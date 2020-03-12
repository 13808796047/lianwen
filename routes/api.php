<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')
    ->namespace('Api')
    ->name('api.v1')
    ->middleware('throttle:' . config('api.rate_limits.sign'))
    ->group(function() {
        //短信验证码
        Route::post('verificationCodes', 'VerificationCodesController@store')
            ->name('verificationCodes.store');
        //用户注册
        Route::post('users', 'UsersController@store')
            ->name('users.store');
        // 刷新token
        Route::put('authorizations/current', 'AuthorizationsController@update')
            ->name('authorizations.update');
        // 删除token
        Route::delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('authorizations.destroy');
        //登录
        Route::post('authorizations', 'AuthorizationsController@store')
            ->name('api.authorizations.store');
//        Route::middleware('throttle:' . config('api.rate_limits.access'))
//            ->group(function() {
//
//            });
    });
