<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect('login');
});

Auth::routes(['verify' => true]);

Route::get('/home', function () {
    return redirect('login');
})->name('home')->middleware('verified');

Route::get('/accounts', 'HomeController@show')->name('accounts.index')->middleware('verified');
Route::get('/accounts/create', 'ServerAccountController@create')->name('accounts.create')->middleware('verified');
Route::post('/accounts', 'ServerAccountController@store')->name('accounts.store')->middleware('verified');
Route::group(['middleware' => ['member.check']], function () {
    Route::get('/accounts/{serverAccount}', 'ServerAccountController@show')->name('accounts.show')->middleware('verified');
    Route::post('/accounts/{serverAccount}/tokens', 'ServerTokenController@store')->name('accounts.tokens.store')->middleware('verified');
    Route::get('/accounts/{serverAccount}/bans', 'ModerationController@index')->name('accounts.bans.index')->middleware('verified')->defaults('type', 0);
    Route::get('/accounts/{serverAccount}/warnings', 'ModerationController@index')->name('accounts.warnings.index')->middleware('verified')->defaults('type', 1);
    Route::get('/accounts/{serverAccount}/members', 'ServerAccountMemberController@index')->name('accounts.members.index')->middleware('verified');
    Route::put('/accounts/{serverAccount}/members/{serverAccountMember}', 'ServerAccountMemberController@update')->name('accounts.members.update')->middleware('verified');
    Route::get('/accounts/{serverAccount}/players', 'ServerAccountPlayerController@index')->name('accounts.players.index')->middleware('verified');
    Route::get('/accounts/{serverAccount}/ranks', 'RankController@index')->name('accounts.ranks.index')->middleware('verified');
    Route::get('/accounts/{serverAccount}/ranks/create', 'RankController@create')->name('accounts.ranks.create')->middleware('verified');
    Route::post('/accounts/{serverAccount}/ranks', 'RankController@store')->name('accounts.ranks.store')->middleware('verified');
    Route::get('/accounts/{serverAccount}/ranks/{rank}/edit', 'RankController@edit')->name('accounts.ranks.edit')->middleware('verified');
    Route::put('/accounts/{serverAccount}/ranks/{rank}', 'RankController@update')->name('accounts.ranks.update')->middleware('verified');
    Route::delete('/accounts/{serverAccount}/ranks/{rank}', 'RankController@destroy')->name('accounts.ranks.destroy')->middleware('verified');
});

//Route::get('/accounts', function () {
//    return view('server_accounts.list');
//})->middleware('auth')->middleware('verified');
