<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');
Route::post('sign-up', 'UsersController@store');  

Route::group(['middleware' => 'auth:api'], function() {
	Route::post('/logout', 'AuthController@logout');
	
	Route::get('/users', 'UsersController@index');
	Route::get('/loggedUser', 'UsersController@showLoggedUser');
});