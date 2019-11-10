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
    return view('copiaWelcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('auth/google', 'Auth\LoginController@redirectToProvider')->name('login');
Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallback');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware'=>['auth']], function () {
    //Catalog
    Route::get('/catalogo', 'CatalogController@index');
    Route::get('/catalogo/search', 'CatalogController@search');
    Route::get('/carrito', 'CartController@index');

    //Profile
    Route::get('/profile', 'UserReservationsController@index');
    Route::get('/profile/history', 'UserReservationsController@history');
    Route::get('/reservations/cancel/{reservation}', 'UserReservationsController@cancel');
    Route::post('/profile/campus', 'ProfileController@campus');
});


Route::group(['middleware'=>['auth', 'role:Administrador|Administrador General']], function () {
    //Roles
    Route::get('/roles', 'UserRoleController@index');
    Route::post('/roles', 'UserRoleController@store');
    Route::post('/roles/update/type/{role}', 'UserRoleController@updateType');
    Route::post('/roles/update/campus/{role}', 'UserRoleController@updateCampus');
    Route::post('/roles/delete/{role}', 'UserRoleController@delete');

    //Tags
    Route::get('/tags', 'TagsController@index');

    //Units
    Route::get('/units', 'UnitsController@index');
    Route::get('/unit/create', 'UnitsController@create');
    Route::get('/unit/store', 'UnitsController@store');
    Route::get('/unit/edit/{id}', 'UnitsController@edit');
    Route::get('/unit/update/{id}', 'UnitsController@update');
    Route::get('/unit/delete/{id}', 'UnitsController@delete');
    Route::get('/unit/activate/{id}', 'UnitsController@activate');

    //Categories
    Route::get('/categories', 'CategoriesController@index');
    Route::get('/category/create', 'CategoriesController@create');
    Route::get('/category/store', 'CategoriesController@store');
    Route::get('/category/edit/{id}', 'CategoriesController@edit');
    Route::get('/category/update/{id}', 'CategoriesController@update');
    Route::get('/category/delete/{id}', 'CategoriesController@delete');
    Route::get('/category/activate/{id}', 'CategoriesController@activate');

    //Products
    Route::get('/products', 'ProductsController@indexAdmin');
    Route::get('/product/create', 'ProductsController@create');
    Route::post('/product/store', 'ProductsController@store');
    Route::get('/product/edit/{id}', 'ProductsController@edit');
    Route::post('/product/update/{id}', 'ProductsController@update');
    Route::get('/product/delete/{id}', 'ProductsController@delete');
    Route::get('/product/activate/{id}', 'ProductsController@activate');
    Route::get('/products/attach/{product}', 'ProductsController@attach');
});
