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
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Reservations
Route::get('/my_reservations', 'UserReservationsController@index');
Route::get('/my_reservations/history', 'UserReservationsController@history');
Route::get('/reservations/cancel/{reservation}', 'UserReservationsController@cancel');

//Products
Route::get('/products', 'ProductsController@indexAdmin');
Route::get('/product/create', 'ProductsController@create');
Route::get('/product/store', 'ProductsController@store');
Route::get('/product/edit/{id}', 'ProductsController@edit');
Route::get('/product/update/{id}', 'ProductsController@update');
Route::get('/product/delete/{id}', 'ProductsController@delete');
Route::get('/product/activate/{id}', 'ProductsController@activate');

//Categories
Route::get('/categories', 'CategoriesController@index');
Route::get('/category/create', 'CategoriesController@create');
Route::get('/category/store', 'CategoriesController@store');
Route::get('/category/edit/{id}', 'CategoriesController@edit');
Route::get('/category/update/{id}', 'CategoriesController@update');
Route::get('/category/delete/{id}', 'CategoriesController@delete');
Route::get('/category/activate/{id}', 'CategoriesController@activate');

//Catalog
Route::get('/my_products', function () {
    return view('profile.my_products')->with(compact('my_products'));
});

Route::group(['middleware'=>['auth', 'role:Administrador|Administrador General']], function () {
    //Roles
    Route::get('/roles', 'UserRoleController@index');
    Route::post('/roles', 'UserRoleController@store');
    Route::post('/roles/update/{role}', 'UserRoleController@update');
    Route::post('/roles/delete/{role}', 'UserRoleController@delete');
});
