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
