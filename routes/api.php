<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');
Route::post('sign-up', 'UsersController@store');  

Route::group(['middleware' => 'auth:api'], function() {
	Route::post('/logout', 'AuthController@logout');
	Route::get('/user/{id}/edit', 'UsersController@edit');
	Route::put('/user/{user}/update', 'UsersController@update');
	
	Route::get('/users', 'UsersController@index');

	///Supplier 
	Route::post('/suppliers', 'SuppliersController@store');
	Route::get('/suppliers', 'SuppliersController@index');
	Route::get('/supplier/{id}/edit', 'SuppliersController@edit');
	Route::put('/supplier/{supplier}/update', 'SuppliersController@update');
	Route::delete('/supplier/{supplier}/destroy', 'SuppliersController@destroy');
});