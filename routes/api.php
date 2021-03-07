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

	//Crud Sales
	Route::post('/sales', 'SalesController@store');
	Route::get('/sales', 'SalesController@index');
	Route::get('/sales/{id}/edit', 'SalesController@edit');
	Route::put('/sales/{sale}/update', 'SalesController@update');
	Route::delete('/sales/{sale}/destroy', 'SalesController@destroy');
});