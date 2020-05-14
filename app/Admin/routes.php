<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('projects', ProjectController::class);
    $router->resource('standards', StandardController::class);
    $router->resource('no-placas', NoPlacaController::class);
    $router->resource('bombas-abastecimiento', BombaAbastecimientoController::class);
    $router->resource('sistemas-amortiguacion', SistemaAmortiguacionController::class);
});
