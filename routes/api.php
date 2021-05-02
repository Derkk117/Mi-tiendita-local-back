<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');
Route::post('sign-up', 'UsersController@store');  
Route::post('/address','AddressesController@store');

Route::group(['middleware' => 'auth:api'], function() {
	Route::post('/logout', 'AuthController@logout');
	Route::get('/current/{email}', 'UsersController@current');
	Route::get('/users', 'UsersController@index');
	Route::get('/user/{id}/edit', 'UsersController@edit');
	Route::put('/user/{user}/update', 'UsersController@update');

	Route::post('/deliveries', 'DeliveriesController@store');
	Route::get('/deliveries/{id}/edit', 'DeliveriesController@edit');
	Route::put('/deliveries/{delivery}/update', 'DeliveriesController@update');
	
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

	Route::post('/sales', 'SalesController@store');
	Route::get('/sales', 'SalesController@index');
	Route::get('/sales/{id}/edit', 'SalesController@edit');
	Route::put('/sales/{sale}/update', 'SalesController@update');
	Route::delete('/sales/{sale}/destroy', 'SalesController@destroy');
 
	Route::get('/address','AddressesController@index');
	Route::get('/address/{id}/edit','AddressesController@edit');
	Route::put('/address/{address}/update','AddressesController@update');

	Route::get('/stores','StoresController@index');
	Route::post('/stores','StoresController@store');
	Route::get('/store/{store}/edit','StoresController@edit');
	Route::put('/store/{store}/update','StoresController@update');
});