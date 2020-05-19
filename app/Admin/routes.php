<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function(Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home.index');
    $router->resource('orders', 'OrderController');
    $router->resource('categories', 'CategoryController');
    $router->resource('users', 'UserController');
    $router->resource('jc_settings', 'JcSettingController');
    $router->get('orders/{order}/download_paper', 'OrderController@downloadPaper')->name('admin.orders.download_paper');
    $router->get('orders/{order}/download_report', 'OrderController@downloadReport')->name('admin.orders.download_report');
    $router->post('orders/{order}/receved', 'OrderController@receved')->name('admin.orders.receved');
});
