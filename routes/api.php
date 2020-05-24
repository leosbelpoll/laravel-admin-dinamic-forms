<?php


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
    Route::get('/version', 'Controller@getVersion')->name('getVersion');

    // Formularios routes
    Route::get('/formularios', 'FormularioController@getAll')->name('getAllFormularios');
    Route::get('/formularios/{id}', 'FormularioController@get')->name('getFormulario');

    // Form Data
    Route::post('/save-values', 'ValueController@saveValues')->name('saveValues');
});

Route::resource('carritos', 'CarritoController');