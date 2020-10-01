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

Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'UserController@index')->name('user.index')->middleware('can:list_user');
    Route::get('{id}/edit', 'UserController@edit')->name('user.edit')->middleware('can:edit_product');
    Route::post('/update/{id}', 'UserController@update')->name('user.update')->middleware('can:update_user');
    Route::post('/delete/{id}', 'UserController@destroy')->name('user.delete')->middleware('can:delete_user');
    Route::post('/add', 'UserController@store')->name('user.store')->middleware('can:add_user');
    Route::get('/list', 'UserController@search')->name('user.list');
    Route::get('/search/{field?}', 'UserController@search')->name('user.search');
    Route::get('/change-status/{id}', 'UserController@changeStatus')->name('user.changeStatus');
    Route::get('/filter-users/{field}', 'UserController@filter')->name('user.filter');
    Route::get('pagination/fetch_data', 'UserController@fetchDataPaginate')->name('user.paginate');
});
Route::group(['prefix' => 'products'], function () {
    Route::get('/','ProductController@index')->name('products.index')->middleware('can:list_product');
    Route::get('{id}/edit', 'ProductController@edit')->name('product.edit')->middleware('can:edit_product');
    Route::post('/update/{id}', 'ProductController@update')->name('product.update')->middleware('can:update_product');
    Route::post('/delete/{id}', 'ProductController@destroy')->name('product.delete')->middleware('can:delete_product');
    Route::post('/add', 'ProductController@store')->name('product.store')->middleware('can:add_product');
    Route::get('/list', 'ProductController@list')->name('products.list');
    Route::get('pagination/fetch_data', 'ProductController@fetchDataPaginate')->name('product.paginate');

});
Route::group(['prefix' => 'product-details', 'middleware' => 'role:user,admin'], function () {
    Route::get('/',
        'ProductDetailController@index')->name('product-details.index')->middleware('can:list_product_detail');
    Route::get('{id}/edit',
        'ProductDetailController@edit')->name('product-details.edit')->middleware('can:edit_product_detail');
    Route::post('/update/{id}',
        'ProductDetailController@update')->name('product-details.update')->middleware('can:update_product_detail');
    Route::post('/delete/{id}',
        'ProductDetailController@destroy')->name('product-details.delete')->middleware('can:delete_product_detail');
    Route::post('/add',
        'ProductDetailController@store')->name('product-details.store')->middleware('can:add_product_detail');
    Route::get('/list', 'ProductDetailController@list')->name('product-details.list');
});
Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'CategoryController@index')->name('category.index')->middleware('can:list_category');
    Route::get('{id}/edit', 'CategoryController@edit')->name('category.edit')->middleware('can:edit_category');
    Route::post('/update/{id}',
        'CategoryController@update')->name('category.update')->middleware('can:update_category');
    Route::post('/delete/{id}', 'CategoryController@destroy')->name('category.delete')->middleware('can:delete_category');
    Route::post('/add', 'CategoryController@store')->name('category.store')->middleware('can:add_category');
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
