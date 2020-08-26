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
    return view('welcome');
});
Route::get('index', function () {
    return view('layouts.master');
});
Route::group(['prefix'=>'users'],function(){
    Route::get('/','UserController@index');
    Route::get('/edit/{id}','UserController@edit')->name('user.edit');
    Route::post('/update/{id}','UserController@update')->name('user.update');
});
