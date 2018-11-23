<?php

use Illuminate\Http\Request;

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

Route::prefix('payments')->as('payments.')->group(function(){
	Route::get('init', 'PaymentsController@init')->name('init');
	Route::get('data', 'PaymentsController@data')->name('data');
	Route::get('paymentById/{id}', 'PaymentsController@paymentById')->name('paymentById');
	Route::post('save', 'PaymentsController@save')->name('save');
	Route::put('update', 'PaymentsController@update')->name('update');
	Route::delete('delete', 'PaymentsController@destroy')->name('delete');
});

Route::prefix('terceros')->as('terceros.')->group(function(){
	Route::get('init', 'TerceroController@init')->name('init');
	Route::get('data', 'TerceroController@data')->name('data');
	Route::get('terceroById/{id}', 'TerceroController@terceroById')->name('terceroById');
	Route::post('save', 'TerceroController@save')->name('save');
	Route::put('update', 'TerceroController@update')->name('update');
	Route::delete('delete', 'TerceroController@destroy')->name('delete');
});
