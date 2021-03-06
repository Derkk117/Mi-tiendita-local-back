<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');
Route::post('sign-up', 'UsersController@store');  

Route::post('/client','ClientsController@store');

Route::group(['middleware' => 'auth:api'], function() {
	Route::post('/logout', 'AuthController@logout');
	Route::get('/user/{id}/edit', 'UsersController@edit');
	Route::put('/user/{user}/update', 'UsersController@update');

	
    Route::get('/client/{id}/edit','ClientsController@edit');
	Route::put('/client/{client}/update','ClientsController@update');

	Route::get('/users', 'UsersController@index');
});