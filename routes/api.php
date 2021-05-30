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

	Route::get('/deliveries/{user}', 'DeliveriesController@index');
	Route::post('/deliveries', 'DeliveriesController@store');
	Route::get('/deliveries/{delivery}/edit', 'DeliveriesController@edit');
	Route::put('/deliveries/{delivery}/update', 'DeliveriesController@update');
	Route::delete('/deliveries/{delivery}/destroy', 'DeliveriesController@destroy');
	
	Route::get('/suppliers', 'SuppliersController@index');
	Route::post('/suppliers', 'SuppliersController@store');
	Route::get('/supplier/{supplier}/edit', 'SuppliersController@edit');
	Route::put('/supplier/{supplier}/update', 'SuppliersController@update');
	Route::delete('/supplier/{supplier}/destroy', 'SuppliersController@destroy');

	Route::post('/client', 'ClientsController@store');
	Route::get('/clients/{user}', 'ClientsController@index');
    Route::get('/client/{client}/edit', 'ClientsController@edit');
	Route::put('/client/{client}/update', 'ClientsController@update');
	Route::delete('/client/{client}/destroy', 'ClientsController@destroy');

	Route::get('/products/{user}', 'ProductsController@index');
	//Crear un nuevo producto
	Route::post('/product', 'ProductsController@store');
	Route::get('/product/{product}/edit', 'ProductsController@edit');
	Route::post('/product/{product}/update', 'ProductsController@update');
	Route::delete('/product/{product}/destroy', 'ProductsController@destroy');

	Route::post('/sales', 'SalesController@store');
	Route::get('/sales/{user}', 'SalesController@index');
	Route::get('/sales/{sale}/edit', 'SalesController@edit');
	Route::put('/sales/{sale}/update', 'SalesController@update');
	Route::delete('/sales/{sale}/destroy', 'SalesController@destroy');
 
	Route::get('/address','AddressesController@index');
	Route::get('/address/{id}/edit','AddressesController@edit');
	Route::put('/address/{address}/update','AddressesController@update');
	Route::get('/addressLast','AddressesController@last');
	Route::post('/address','AddressesController@store');

	Route::get('/stores','StoresController@index');
	Route::post('/stores','StoresController@store');
	Route::get('/store/{store}/edit','StoresController@edit');
	Route::put('/store/{store}/update','StoresController@update');

	Route::post('/cutoff', 'CutoffController@store');
	Route::get('/cutoff/{user}', 'CutoffController@index');
	Route::get('/cutoff/{cutoff}/edit', 'CutoffController@edit');
	Route::delete('/cutoff/{cutoff}/destroy', 'CutoffController@destroy');

	Route::get('/histories/{user}', 'HistoriesController@index');
	Route::post('/histories','HistoriesController@store');
});