<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('admin.home');
});

Route::group([
    'prefix'        => config('admin.route.prefix') . '/api',
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->resource('fields', FieldController::class);
    $router->resource('formularios', FormularioController::class);
    $router->resource('values', ValueController::class)->only([
        'index', 'show'
    ]);
});
