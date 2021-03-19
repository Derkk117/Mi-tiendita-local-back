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

	//Crud Sales
	Route::post('/sales', 'SalesController@store');
	Route::get('/sales', 'SalesController@index');
	Route::get('/sales/{id}/edit', 'SalesController@edit');
	Route::put('/sales/{sale}/update', 'SalesController@update');
	Route::delete('/sales/{sale}/destroy', 'SalesController@destroy');

	//Crud Street 
	Route::post('/addresses','AddressesController@store');
	Route::get('/addresses','AddressesController@index');
	Route::get('/addresses/{id}/edit','AddressesController@edit');
	Route::put('/addresses/{address}/update','AddressesController@update');
});