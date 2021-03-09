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

//Voucher
Route::get('voucher', 'Admin\VoucherController@index')->name('voucher.index');
Route::post('voucher/store','Admin\VoucherController@store')->name('voucher.store');
Route::get('voucher/destroy/{id}','Admin\VoucherController@destroy')->name('voucher.destroy');
Route::get('voucher/edit/{id}', 'Admin\VoucherController@edit')->name('voucher.edit');
Route::patch('voucher/update', 'Admin\VoucherController@update')->name('voucher.update');
Route::post('voucher/import','Admin\VoucherController@import_excel')->name('voucher.import');


});
