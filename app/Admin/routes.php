<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function(Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('users', 'UsersController@index');
    $router->resource('categories', CategoriesController::class);
//    $router->get('categories', 'CategoriesController@index');
//    $router->get('categories/create', 'CategoriesController@create');
//    $router->post('categories', 'CategoriesController@store');
//    $router->get('categories/{id}/edit', 'CategoriesController@edit');
//    $router->put('categories/{id}', 'CategoriesController@update');
//    $router->resource('orders', OrdersController::class);
    $router->get('orders', 'OrdersController@index')->name('admin.orders.index');
    $router->get('orders/{order}', 'OrdersController@show')->name('admin.orders.show');
    $router->post('repeat_check/{order}', 'OrdersController@repeatCheck')->name('admin.orders.repeat_check');
});
