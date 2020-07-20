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

Route::get('/', function () {return view('welcome');});

Auth::routes(['register' => false]);
// Auth::routes(['register' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'accounts'], function() {
    Route::get('', 'AccountController@index')->name('account.index');
    Route::get('create', 'AccountController@create')->name('account.create');
    Route::post('store', 'AccountController@store')->name('account.store');
    Route::get('edit/{account}', 'AccountController@edit')->name('account.edit');
    Route::post('update/{account}', 'AccountController@update')->name('account.update');
    Route::post('delete/{account}', 'AccountController@destroy')->name('account.destroy');
    Route::get('show/{account}', 'AccountController@show')->name('account.show');

    Route::post('add/{account}', 'AccountController@add')->name('account.add');
    Route::post('remove/{account}', 'AccountController@remove')->name('account.remove');
});