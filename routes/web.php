<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login')->name('');
});
Route::get('index', function () {
    return view('layouts.master');
});
Route::group(['prefix' => 'users', 'middleware' => 'role:admin,user'], function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('{id}/edit', 'UserController@edit')->name('user.edit');
    Route::post('/update/{id}', 'UserController@update')->name('user.update');
    Route::post('/delete/{id}', 'UserController@destroy')->name('user.delete');
    Route::post('/add', 'UserController@store')->name('user.store');
    Route::get('/list', 'UserController@list')->name('user.list');
    Route::get('/search', 'UserController@search')->name('user.search');
    Route::get('/change-status/{id}', 'UserController@changeStatus')->name('user.changeStatus');
    Route::get('/filter-users/{field}', 'UserController@filter')->name('user.filter');
});
Route::group(['prefix' => 'products', 'middleware' => 'role:user,admin'], function () {
    Route::get('/', 'ProductController@index')->name('products.index');
    Route::get('{id}/edit', 'ProductController@edit')->name('product.edit');
    Route::post('/update/{id}', 'ProductController@update')->name('product.update');
    Route::post('/delete/{id}', 'ProductController@destroy')->name('product.delete');
    Route::post('/add', 'ProductController@store')->name('product.store');
    Route::get('/list', 'ProductController@list')->name('products.list');
});
Route::group(['prefix' => 'categories', 'middleware' => 'role:user,admin'], function () {
    Route::get('/', 'CategoryController@index')->name('category.index');
    Route::get('{id}/edit', 'CategoryController@edit')->name('category.edit');
    Route::post('/update/{id}', 'CategoryController@update')->name('category.update');
    Route::post('/delete/{id}', 'CategoryController@destroy')->name('category.delete');
    Route::post('/add', 'CategoryController@store')->name('category.store');
    Route::get('/list', 'CategoryController@list')->name('category.list');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
