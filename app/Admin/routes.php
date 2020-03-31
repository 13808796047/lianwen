<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function(Router $router) {
    $router->get('/', 'HomeController@index')->name('admin.home.index');
    $router->get('order_statistics', 'HomeController@orderStatistics')->name('admin.home.statis');
    $router->get('users', 'UsersController@index');
    $router->resource('categories', CategoriesController::class);
    $router->resource('orders', OrdersController::class)->only(['index', 'show', 'edit']);
    $router->post('orders/{order}/receved', 'OrdersController@receved')->name('admin.orders.receved');

    $router->get('orders/{order}/download_paper', 'OrdersController@downloadPaper')->name('admin.orders.download_paper');
    $router->get('orders/{order}/download_report', 'OrdersController@downloadReport')->name('admin.orders.download_report');
    $router->post('repeat_check/{order}', 'OrdersController@repeatCheck')->name('admin.orders.repeat_check');
});
