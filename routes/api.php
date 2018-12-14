<?php

use Illuminate\Http\Request;

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
	Route::get('terceroSearch/{data}/{type}', 'TerceroController@terceroSearch')->name('terceroSearch');
	Route::post('save', 'TerceroController@save')->name('save');
	Route::put('update', 'TerceroController@update')->name('update');
	Route::delete('delete', 'TerceroController@destroy')->name('delete');
});

Route::prefix('cupons')->as('cupons.')->group(function(){
	Route::get('init', 'CuponsController@init')->name('init');
	Route::get('data', 'CuponsController@data')->name('data');
	Route::get('cuponsById/{id}', 'CuponsController@paymentById')->name('cuponsById');
	Route::post('save', 'CuponsController@save')->name('save');
	Route::put('update', 'CuponsController@update')->name('update');
	Route::delete('delete', 'CuponsController@destroy')->name('delete');
});

Route::prefix('document')->as('document.')->group(function(){
	Route::post('save', 'DocumentController@save')->name('save');
	Route::get('getCupon/{data}', 'DocumentController@getCupon');
});

Route::prefix('documentDetail')->as('documentDetail.')->group(function(){
	Route::get('documentDetail/{code}/{pormayor}', 'DocumentDetailController@getDetailByIdDocument');
});

Route::prefix('setup')->as('setup.')->group(function(){
	Route::get('get', 'SetupController@get');
});
