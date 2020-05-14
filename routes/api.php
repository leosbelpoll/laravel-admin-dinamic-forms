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

// Auth routes
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login')->name('auth.login');
    Route::post('logout', 'AuthController@logout')->name('auth.logout');
    Route::post('refresh', 'AuthController@refresh')->name('auth.refresh');
    Route::post('me', 'AuthController@me')->name('auth.me');
});

Route::middleware('auth:api')->group(function ($router) {
    // Projects routes
    Route::get('/projects', 'ProjectController@getAll')->name('getAllProjects');
    Route::get('/projects/{id}', 'ProjectController@get')->name('getProject');

    // Standards routes
    Route::get('/standards', 'StandardController@getAll')->name('getAllStandards');
    Route::get('/standards/{id}', 'StandardController@get')->name('getStandard');

    // Forms routes
    Route::get('/forms', 'FormController@getAll')->name('getAllForms');
    Route::get('/forms/{id}', 'FormController@get')->name('getForm');

    // Vehicles routes
    Route::get('/no-placas', 'NoPlacaController@getAll')->name('getAllNoPlacas');
    Route::get('/bombas-abastecimiento', 'BombaAbastecimientoController@getAll')->name('getAllBombasAbastecimiento');
    Route::get('/sistemas-amortiguacion', 'SistemaAmortiguacionController@getAll')->name('getAllSistemasAmortiguacion');
    Route::get('/estados-medicion', 'EstadoMedicionController@getAll')->name('getAllEstadoMedicion');
});
