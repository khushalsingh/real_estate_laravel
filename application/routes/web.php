<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('/', 'PageController@index');

Route::match(['get', 'post'], '/login', 'AuthController@login');
Route::get('/logout', function() {
    Session::forget('user');
    return Redirect::to(url('/'));
});

Route::get('/dashboard', 'DashboardController@index');

Route::match(['get', 'post'], '/add_property', 'EstateController@add_property');
Route::match(['get', 'post'], '/add_tenancy', 'EstateController@add_tenancy');
Route::match(['get', 'post'], '/add_tenant', 'EstateController@add_tenant');
