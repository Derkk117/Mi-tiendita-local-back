<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');
Route::post('sign-up', 'UsersController@store');  

Route::group(['middleware' => 'auth:api'], function() {
	Route::post('/logout', 'AuthController@logout');
	
	Route::get('/users', 'UsersController@index');
	Route::get('/user/{user}/edit', 'UsersController@edit');
	Route::put('/user/{user}/update', 'UsersController@update');
	
	Route::get('/suppliers', 'SuppliersController@index');
	Route::post('/suppliers', 'SuppliersController@store');
	Route::get('/supplier/{supplier}/edit', 'SuppliersController@edit');
	Route::put('/supplier/{supplier}/update', 'SuppliersController@update');
	Route::delete('/supplier/{supplier}/destroy', 'SuppliersController@destroy');

	Route::post('/client', 'ClientsController@store');
    Route::get('/client/{client}/edit', 'ClientsController@edit');
	Route::put('/client/{client}/update', 'ClientsController@update');

	Route::get('/products', 'ProductsController@index');
	Route::post('/product', 'ProductsController@store');
	Route::get('/product/{product}/edit', 'ProductsController@edit');
	Route::post('/product/{product}/update', 'ProductsController@update');
});