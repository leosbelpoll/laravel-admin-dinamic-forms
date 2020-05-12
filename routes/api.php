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
    // Route::post('/projects', 'ProjectController@create')->name('createProject');
    // Route::put('/projects/{id}', 'ProjectController@update')->name('updateProject');
    // Route::delete('/projects/{id}', 'ProjectController@delete')->name('deleteProject');

    // Standards routes
    Route::get('/standards', 'StandardController@getAll')->name('getAllStandards');
    Route::get('/standards/{id}', 'StandardController@get')->name('getStandard');
    // Route::post('/standards', 'StandardController@create')->name('createStandard');
    // Route::put('/standards/{id}', 'StandardController@update')->name('updateStandard');
    // Route::delete('/standards/{id}', 'StandardController@delete')->name('deleteStandard');

    // Forms routes
    Route::get('/forms', 'FormController@getAll')->name('getAllForms');
    Route::get('/forms/{id}', 'FormController@get')->name('getForm');
    // Route::post('/forms', 'FormController@create')->name('createForm');
    // Route::put('/forms/{id}', 'FormController@update')->name('updateForm');
    // Route::delete('/forms/{id}', 'FormController@delete')->name('deleteForm');
});
