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
    return view('welcome')->name('');
});
Route::get('index', function () {
    return view('layouts.master');
});
Route::group(['prefix'=>'users'],function(){
    Route::get('/','UserController@index')->name('user.index');
    Route::get('/edit/{id}','UserController@edit')->name('user.edit');
    Route::post('/update/{id}','UserController@update')->name('user.update');
    Route::post('/delete/{id}','UserController@destroy')->name('user.delete');
    Route::post('/add','UserController@store')->name('user.store');
    Route::get('/list','UserController@list')->name('user.list');
    Route::get('/search','UserController@search')->name('user.search');
    Route::get('/change-status/{id}','UserController@changeStatus')->name('user.changeStatus');
    Route::get('/filter-users/{field}','UserController@filter')->name('user.filter');
});
Route::group(['prefix'=>'products'],function(){
    Route::get('/','ProductController@index')->name('products.index');
    Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
    Route::post('/update/{id}','ProductController@update')->name('product.update');
    Route::post('/delete/{id}','ProductController@destroy')->name('product.delete');
    Route::post('/add','ProductController@store')->name('product.store');
    Route::get('/list','ProductController@list')->name('products.list');
});
Route::group(['prefix'=>'categories'],function(){
    Route::get('/','CategoryController@index')->name('category.index');
    Route::get('/edit/{id}','CategoryController@edit')->name('category.edit');
    Route::post('/update/{id}','CategoryController@update')->name('category.update');
    Route::post('/delete/{id}','CategoryController@destroy')->name('category.delete');
    Route::post('/add','CategoryController@store')->name('category.store');
    Route::get('/list','CategoryController@list')->name('category.list');
});
