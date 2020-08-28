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
