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
})->name('home');;

Route::get('auth/google', 'Auth\LoginController@redirectToProvider')->name('login');
Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallback');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware'=>['auth']], function () {
    //Catalog
    Route::get('/catalogo', 'CatalogController@index');
    Route::get('/catalogo/search', 'CatalogController@search');
    Route::get('/canasta', 'CartController@index');
    Route::get('/cart/add/{product}', 'CartController@add');
    Route::get('/cart/remove/{product}', 'CartController@remove');
    Route::post('/cart/update/{item}', 'CartController@update');
    Route::post('/cart/submit', 'CartController@submit');

    //Profile
    Route::get('/profile', 'UserReservationsController@index');
    Route::get('/profile/history', 'UserReservationsController@history');
    Route::get('/reservations/{reservation}/cancel', 'UserReservationsController@cancel');
    Route::post('/profile/campus', 'ProfileController@campus');
});


Route::group(['middleware'=>['auth', 'role:Coordinador|Administrador|Administrador General']], function () {
    //Tags
    Route::get('/tags', 'TagsController@index');
    Route::get('/tag/create', 'TagsController@create');
    Route::get('/tag/store', 'TagsController@store');
    Route::get('/tag/edit/{id}', 'TagsController@edit');
    Route::get('/tag/update/{id}', 'TagsController@update');
    Route::get('/tag/delete/{id}', 'TagsController@delete');
    Route::get('/tag/activate/{id}', 'TagsController@activate');

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
    Route::get('/products/{product}', 'ProductsController@show');
    Route::get('/products', 'ProductsController@index');
    Route::get('/product/create', 'ProductsController@create');
    Route::post('/product/store', 'ProductsController@store');
    Route::get('/product/edit/{id}', 'ProductsController@edit');
    Route::post('/product/update/{id}', 'ProductsController@update');
    Route::get('/product/attach/{product}', 'ProductsController@attach');
    Route::get('/product/detach/{product}', 'ProductsController@detach');

    //Maintenances
    Route::get('/maintenances', 'MaintenancesController@index');
    Route::get('/maintenances/create/{unit}', 'MaintenancesController@create');
    Route::post('/maintenances/store', 'MaintenancesController@store');
    Route::post('/maintenances/finish/{maintenance}', 'MaintenancesController@finish');
    Route::post('/maintenances/delete/{maintenance}', 'MaintenancesController@delete');

    //Dashboard
    Route::get('/dashboard', 'DashboardController@index');
    Route::post('/reservations/{reservation}/status', 'UserReservationsController@status');
    Route::post('/reservations/{reservation}/loan', 'UserReservationsController@loan');

    //Notificaciones
    Route::get('/reminders/send', 'DashboardController@remind');
});

Route::group(['middleware'=>['auth', 'role:Administrador|Administrador General']], function () {
    //Roles
    Route::get('/roles', 'UserRoleController@index');
    Route::post('/roles', 'UserRoleController@store');
    Route::post('/roles/update/type/{role}', 'UserRoleController@updateType');
    Route::post('/roles/update/campus/{role}', 'UserRoleController@updateCampus');
    Route::post('/roles/delete/{role}', 'UserRoleController@delete');

    //Reportes
    Route::get('/reports', 'ReportController@index');
    Route::get('/reports/export', 'ReportController@export');
});
