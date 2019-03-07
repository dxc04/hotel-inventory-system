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


// products
Route::get('admin/products', 'Admin\ProductController@index')->name('admin.products');
Route::get('admin/products/create', 'Admin\ProductController@createForm')->name('admin.products.create');
Route::post('admin/products/create', 'Admin\ProductController@create');
Route::get('admin/products/read/{product}', 'Admin\ProductController@read')->name('admin.products.read');
Route::get('admin/products/update/{product}', 'Admin\ProductController@updateForm')->name('admin.products.update');
Route::patch('admin/products/update/{product}', 'Admin\ProductController@update');
Route::delete('admin/products/delete/{product}', 'Admin\ProductController@delete')->name('admin.products.delete');

// suppliers
Route::get('admin/suppliers', 'Admin\SupplierController@index')->name('admin.suppliers');
Route::get('admin/suppliers/create', 'Admin\SupplierController@createForm')->name('admin.suppliers.create');
Route::post('admin/suppliers/create', 'Admin\SupplierController@create');
Route::get('admin/suppliers/read/{supplier}', 'Admin\SupplierController@read')->name('admin.suppliers.read');
Route::get('admin/suppliers/update/{supplier}', 'Admin\SupplierController@updateForm')->name('admin.suppliers.update');
Route::patch('admin/suppliers/update/{supplier}', 'Admin\SupplierController@update');
Route::delete('admin/suppliers/delete/{supplier}', 'Admin\SupplierController@delete')->name('admin.suppliers.delete');