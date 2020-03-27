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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:server_api')->group(function () {
    Route::get('/servers', 'API\ServerController@index')->name('api.servers');
    Route::post('/servers', 'API\ServerController@store')->name('api.servers.store');
    Route::get('/servers/{server}', 'API\ServerController@show')->name('api.servers.show');
});
