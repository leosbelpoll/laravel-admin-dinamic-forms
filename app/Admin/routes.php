<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('api/projects', ProjectController::class);
    $router->resource('api/standards', StandardController::class);
    $router->resource('api/no-placas', NoPlacaController::class);
    $router->resource('api/bombas-abastecimiento', BombaAbastecimientoController::class);
    $router->resource('api/sistemas-amortiguacion', SistemaAmortiguacionController::class);
    $router->resource('api/estados-medicion', EstadoMedicionController::class);
});
