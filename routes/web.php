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

Route::group(['middleware' => 'auth:api'], function() {
    Route::resource('api/orders', 'OrdersController');
});

//Auth::guard('api')->user(); // instance of the logged user
//Auth::guard('api')->check(); // if a user is authenticated
//Auth::guard('api')->id(); // the id of the authenticated user

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/api/login', 'Auth\LoginController@loginPage');
Route::post('/api/login', 'Auth\LoginController@loginApi')->name('api.login');
Route::get('/api/logout', 'Auth\LoginController@logoutApi');
Route::get('/api/users', 'HomeController@getUsers');
Route::get('/api/categories', 'HomeController@getCategories');
Route::get('/api/foods', 'HomeController@getFoods');
Route::get('/api/floors', 'HomeController@getFloors');
Route::get('/api/tables', 'HomeController@getTables');
