<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');
Route::post('sign-up', 'UsersController@store');  

Route::group(['middleware' => 'auth:api'], function() {
	Route::post('/logout', 'AuthController@logout');
	Route::get('/user/{id}/edit', 'UsersController@edit');
	Route::put('/user/{user}/update', 'UsersController@update');

	//Delivery
	Route::post('/deliveries', 'DeliveriesController@store');
	Route::get('/deliveries/{id}/edit', 'DeliveriesController@edit');
	Route::put('/deliveries/{delivery}/update', 'DeliveriesController@update');

	
	Route::get('/users', 'UsersController@index');
});