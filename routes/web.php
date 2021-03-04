<?php

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
    return redirect('/login');
});

Route::group(['prefix' => '/'], function()
{
//AUTH ADM
Route::get('login', 'Admin\AuthAdminController@showLoginForm')->name('showlogin');
Route::post('login','Admin\AuthAdminController@login')->name('login');
Route::post('logout','Admin\AuthAdminController@logout')->name('logout');
Route::get('home', 'Admin\HomeController@index')->name('home');
Route::get('voucher', 'Admin\VoucherController@index')->name('voucher.index');
});
