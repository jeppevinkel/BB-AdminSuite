<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/accounts', 'HomeController@show')->name('accounts')->middleware('verified');
Route::group(['middleware' => ['member.check']], function () {
    Route::get('/accounts/{serverAccount}', 'ServerAccountController@show')->name('accounts.show')->middleware('verified');
    Route::post('/accounts/{serverAccount}/tokens', 'ServerTokenController@store')->name('accounts.tokens.store')->middleware('verified');
    Route::get('/accounts/{serverAccount}/bans', 'ModerationController@index')->name('accounts.bans.index')->middleware('verified')->defaults('type', 0);
    Route::get('/accounts/{serverAccount}/warnings', 'ModerationController@index')->name('accounts.warnings.index')->middleware('verified')->defaults('type', 1);
});

//Route::get('/accounts', function () {
//    return view('server_accounts.list');
//})->middleware('auth')->middleware('verified');
