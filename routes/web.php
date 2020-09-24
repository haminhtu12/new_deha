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

//Route::get('index', function () {
//    return view('layouts.master');
//});
Route::group(['prefix' => 'users'], function () {
    Route::get('/', ['uses' => 'UserController@index', 'middleware' => 'can:list_user'])->name('user.index');
    Route::get('{id}/edit', ['uses' => 'UserController@edit', 'middleware' => 'can:edit_product'])->name('user.edit');
    Route::post('/update/{id}',
        ['uses' => 'UserController@update', 'middleware' => 'can:update_user'])->name('user.update');
    Route::post('/delete/{id}', 'UserController@destroy')->name('user.delete')->middleware('can:delete_user');
    Route::post('/add', ['UserController@store', 'middleware' => 'can:add_user'])->name('user.store');
    Route::get('/list', 'UserController@search')->name('user.list');
    Route::get('/search/{field?}', 'UserController@search')->name('user.search');
    Route::get('/change-status/{id}', 'UserController@changeStatus')->name('user.changeStatus');
    Route::get('/filter-users/{field}', 'UserController@filter')->name('user.filter');
    Route::get('pagination/fetch_data', 'UserController@fetchDataPaginate');
});
Route::group(['prefix' => 'products'], function () {
    Route::get('/', ['uses' => 'ProductController@index', 'middleware' => 'can:list_product'])->name('products.index');
    Route::get('{id}/edit',
        ['uses' => 'ProductController@edit', 'middleware' => 'can:edit_product'])->name('product.edit');
    Route::post('/update/{id}',
        ['uses' => 'ProductController@update', 'middleware' => 'can:update_product'])->name('product.update');
    Route::post('/delete/{id}',
        ['uses' => 'ProductController@destroy', 'middleware' => 'can:delete_product'])->name('product.delete');
    Route::post('/add',
        ['uses' => 'ProductController@store', 'middleware' => 'can:add_product'])->name('product.store');
    Route::get('/list', 'ProductController@list')->name('products.list');
});
Route::group(['prefix' => 'product-details', 'middleware' => 'role:user,admin'], function () {
    Route::get('/', [
        'uses' => 'ProductDetailController@index',
        'middleware' => 'can:list_product_detail'
    ])->name('product-details.index');
    Route::get('{id}/edit', [
        'uses' => 'ProductDetailController@edit',
        'middleware' => 'can:edit_product_detail'
    ])->name('product-details.edit');
    Route::post('/update/{id}', [
        'uses' => 'ProductDetailController@update',
        'middleware' => 'can:update_product_detail'
    ])->name('product-details.update');
    Route::post('/delete/{id}', [
        'uses' => 'ProductDetailController@destroy',
        'middleware' => 'can:delete_product_detail'
    ])->name('product-details.delete');
    Route::post('/add', [
        'uses' => 'ProductDetailController@store',
        'middleware' => 'can:add_product_detail'
    ])->name('product-details.store');
    Route::get('/list', ['uses' => 'ProductDetailController@list'])->name('product-details.list');
});
Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'CategoryController@index')->name('category.index')->middleware('can:list_category');
    Route::get('{id}/edit',
        ['uses' => 'CategoryController@edit', 'middleware' => 'can:edit_category'])->name('category.edit');
    Route::post('/update/{id}',
        ['uses' => 'CategoryController@update', 'middleware' => 'can:update_category'])->name('category.update');
    Route::post('/delete/{id}',
        ['uses' => 'CategoryController@destroy', 'middleware' => 'can:delete_category'])->name('category.delete');
    Route::post('/add',
        ['uses' => 'CategoryController@store', 'middleware' => 'can:add_category'])->name('category.store');
    Route::get('/list', 'CategoryController@list')->name('category.list');
});
Route::group(['prefix' => 'roles'], function () {
    Route::get('/', 'RoleController@index')->name('roles.index');
    Route::get('{id}/edit', 'RoleController@edit')->name('role.edit');
    Route::post('/update/{id}', 'RoleController@update')->name('role.update');
    Route::post('/delete/{id}', 'RoleController@destroy')->name('role.delete');
    Route::post('/add', 'RoleController@store')->name('roles.store');
    Route::get('/list', 'RoleController@list')->name('roles.list');
});


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
//Route::get('/', function () {
//    return view('auth.login')->name('');
//});
