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


// suppliers
Route::get('admin/suppliers', 'Admin\SupplierController@index')->name('admin.suppliers');
Route::get('admin/suppliers/create', 'Admin\SupplierController@createForm')->name('admin.suppliers.create');
Route::post('admin/suppliers/create', 'Admin\SupplierController@create');
Route::get('admin/suppliers/read/{supplier}', 'Admin\SupplierController@read')->name('admin.suppliers.read');
Route::get('admin/suppliers/update/{supplier}', 'Admin\SupplierController@updateForm')->name('admin.suppliers.update');
Route::patch('admin/suppliers/update/{supplier}', 'Admin\SupplierController@update');
Route::delete('admin/suppliers/delete/{supplier}', 'Admin\SupplierController@delete')->name('admin.suppliers.delete');

// guests
Route::get('admin/guests', 'Admin\GuestController@index')->name('admin.guests');
Route::get('admin/guests/create', 'Admin\GuestController@createForm')->name('admin.guests.create');
Route::post('admin/guests/create', 'Admin\GuestController@create');
Route::get('admin/guests/read/{guest}', 'Admin\GuestController@read')->name('admin.guests.read');
Route::get('admin/guests/update/{guest}', 'Admin\GuestController@updateForm')->name('admin.guests.update');
Route::patch('admin/guests/update/{guest}', 'Admin\GuestController@update');
Route::delete('admin/guests/delete/{guest}', 'Admin\GuestController@delete')->name('admin.guests.delete');

// statuses
Route::get('admin/statuses', 'Admin\StatusController@index')->name('admin.statuses');
Route::get('admin/statuses/create', 'Admin\StatusController@createForm')->name('admin.statuses.create');
Route::post('admin/statuses/create', 'Admin\StatusController@create');
Route::get('admin/statuses/read/{status}', 'Admin\StatusController@read')->name('admin.statuses.read');
Route::get('admin/statuses/update/{status}', 'Admin\StatusController@updateForm')->name('admin.statuses.update');
Route::patch('admin/statuses/update/{status}', 'Admin\StatusController@update');
Route::delete('admin/statuses/delete/{status}', 'Admin\StatusController@delete')->name('admin.statuses.delete');

// room_types
Route::get('admin/room_types', 'Admin\RoomTypeController@index')->name('admin.room_types');
Route::get('admin/room_types/create', 'Admin\RoomTypeController@createForm')->name('admin.room_types.create');
Route::post('admin/room_types/create', 'Admin\RoomTypeController@create');
Route::get('admin/room_types/read/{room_type}', 'Admin\RoomTypeController@read')->name('admin.room_types.read');
Route::get('admin/room_types/update/{room_type}', 'Admin\RoomTypeController@updateForm')->name('admin.room_types.update');
Route::patch('admin/room_types/update/{room_type}', 'Admin\RoomTypeController@update');
Route::delete('admin/room_types/delete/{room_type}', 'Admin\RoomTypeController@delete')->name('admin.room_types.delete');



// rooms
Route::get('admin/rooms', 'Admin\RoomController@index')->name('admin.rooms');
Route::get('admin/rooms/create', 'Admin\RoomController@createForm')->name('admin.rooms.create');
Route::post('admin/rooms/create', 'Admin\RoomController@create');
Route::get('admin/rooms/read/{room}', 'Admin\RoomController@read')->name('admin.rooms.read');
Route::get('admin/rooms/update/{room}', 'Admin\RoomController@updateForm')->name('admin.rooms.update');
Route::patch('admin/rooms/update/{room}', 'Admin\RoomController@update');
Route::delete('admin/rooms/delete/{room}', 'Admin\RoomController@delete')->name('admin.rooms.delete');


// room_statuses
Route::get('admin/room_statuses', 'Admin\RoomStatusController@index')->name('admin.room_statuses');
Route::get('admin/room_statuses/create', 'Admin\RoomStatusController@createForm')->name('admin.room_statuses.create');
Route::post('admin/room_statuses/create', 'Admin\RoomStatusController@create');
Route::get('admin/room_statuses/read/{room_status}', 'Admin\RoomStatusController@read')->name('admin.room_statuses.read');
Route::get('admin/room_statuses/update/{room_status}', 'Admin\RoomStatusController@updateForm')->name('admin.room_statuses.update');
Route::patch('admin/room_statuses/update/{room_status}', 'Admin\RoomStatusController@update');
Route::delete('admin/room_statuses/delete/{room_status}', 'Admin\RoomStatusController@delete')->name('admin.room_statuses.delete');

// purchases
Route::get('admin/purchases', 'Admin\PurchaseController@index')->name('admin.purchases');
Route::get('admin/purchases/create', 'Admin\PurchaseController@createForm')->name('admin.purchases.create');
Route::post('admin/purchases/create', 'Admin\PurchaseController@create');
Route::get('admin/purchases/read/{purchase}', 'Admin\PurchaseController@read')->name('admin.purchases.read');
Route::get('admin/purchases/update/{purchase}', 'Admin\PurchaseController@updateForm')->name('admin.purchases.update');
Route::patch('admin/purchases/update/{purchase}', 'Admin\PurchaseController@update');
Route::delete('admin/purchases/delete/{purchase}', 'Admin\PurchaseController@delete')->name('admin.purchases.delete');

// stocks_transactions
Route::get('admin/stocks_transactions', 'Admin\StocksTransactionController@index')->name('admin.stocks_transactions');
Route::get('admin/stocks_transactions/create', 'Admin\StocksTransactionController@createForm')->name('admin.stocks_transactions.create');
Route::post('admin/stocks_transactions/create', 'Admin\StocksTransactionController@create');
Route::get('admin/stocks_transactions/read/{stocks_transaction}', 'Admin\StocksTransactionController@read')->name('admin.stocks_transactions.read');
Route::get('admin/stocks_transactions/update/{stocks_transaction}', 'Admin\StocksTransactionController@updateForm')->name('admin.stocks_transactions.update');
Route::patch('admin/stocks_transactions/update/{stocks_transaction}', 'Admin\StocksTransactionController@update');
Route::delete('admin/stocks_transactions/delete/{stocks_transaction}', 'Admin\StocksTransactionController@delete')->name('admin.stocks_transactions.delete');

// items
Route::get('admin/items', 'Admin\ItemController@index')->name('admin.items');
Route::get('admin/items/create', 'Admin\ItemController@createForm')->name('admin.items.create');
Route::post('admin/items/create', 'Admin\ItemController@create');
Route::get('admin/items/read/{item}', 'Admin\ItemController@read')->name('admin.items.read');
Route::get('admin/items/update/{item}', 'Admin\ItemController@updateForm')->name('admin.items.update');
Route::patch('admin/items/update/{item}', 'Admin\ItemController@update');
Route::delete('admin/items/delete/{item}', 'Admin\ItemController@delete')->name('admin.items.delete');


// bookings
Route::get('admin/bookings', 'Admin\BookingController@index')->name('admin.bookings');
Route::get('admin/bookings/create', 'Admin\BookingController@createForm')->name('admin.bookings.create');
Route::post('admin/bookings/create', 'Admin\BookingController@create');
Route::get('admin/bookings/read/{booking}', 'Admin\BookingController@read')->name('admin.bookings.read');
Route::get('admin/bookings/update/{booking}', 'Admin\BookingController@updateForm')->name('admin.bookings.update');
Route::patch('admin/bookings/update/{booking}', 'Admin\BookingController@update');
Route::delete('admin/bookings/delete/{booking}', 'Admin\BookingController@delete')->name('admin.bookings.delete');