<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('auth/google', 'Auth\LoginController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallback');
Auth::routes();

//Reservations
Route::get('/my_reservations', 'UserReservationsController@index');
Route::get('/my_reservations/history', 'UserReservationsController@history');
Route::get('/reservations/cancel/{reservation}', 'UserReservationsController@cancel');

//Products
Route::get('/products', 'ProductsController@index');
Route::get('/product/create', 'ProductsController@create');
Route::get('/product/store', 'ProductsController@store');
Route::get('/product/edit/{id}', 'ProductsController@edit');
Route::get('/product/update/{id}', 'ProductsController@update');
Route::get('/product/delete/{id}', 'ProductsController@delete');
Route::get('/product/activate/{id}', 'ProductsController@activate');

//Units
Route::get('/units', 'UnitsController@index');
Route::get('/unit/create', 'UnitsController@create');
Route::get('/unit/store', 'UnitsController@store');
Route::get('/unit/edit/{id}', 'UnitsController@edit');
Route::get('/unit/update/{id}', 'UnitsController@update');
Route::get('/unit/delete/{id}', 'UnitsController@delete');
Route::get('/unit/activate/{id}', 'UnitsController@activate');
