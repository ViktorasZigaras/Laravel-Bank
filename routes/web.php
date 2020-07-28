<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {return view('welcome');});

Auth::routes(['register' => false]);

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'accounts'], function() {
    Route::get ('',                 'AccountController@index')   ->name('account.index');
    Route::get ('create',           'AccountController@create')  ->name('account.create');
    Route::post('store',            'AccountController@store')   ->name('account.store');
    Route::get ('edit/{account}',   'AccountController@edit')    ->name('account.edit');
    Route::post('update/{account}', 'AccountController@update')  ->name('account.update');
    Route::post('delete/{account}', 'AccountController@destroy') ->name('account.destroy');
    // Route::get ('show/{account}',   'AccountController@show')    ->name('account.show');
    Route::post('add/{account}',    'AccountController@add')     ->name('account.add');
    Route::post('remove/{account}', 'AccountController@remove')  ->name('account.remove');
});

Route::group(['prefix' => 'accountsJS'], function() {
    Route::get ('',                 'AccountController@indexJS');
    Route::post('',                 'AccountController@indexJSdata');
    Route::post('create',           'AccountController@createJS');
    Route::post('store',            'AccountController@storeJS');
    Route::post('edit/{account}',   'AccountController@editJS');
    Route::post('update/{account}', 'AccountController@updateJS');
    Route::post('delete/{account}', 'AccountController@destroyJS');
    Route::post('add/{account}',    'AccountController@addJS');
    Route::post('remove/{account}', 'AccountController@removeJS');
});