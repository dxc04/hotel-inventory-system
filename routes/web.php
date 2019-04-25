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

Route::get('/{any}', 'HomeController@index')->where('any', '^(home|rooms|notes|check-rooms)$');
Route::get('/', 'HomeController@index');
Auth::routes();

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

// config_definitions
Route::get('admin/config_definitions', 'Admin\ConfigDefinitionController@index')->name('admin.config_definitions');
Route::get('admin/config_definitions/create', 'Admin\ConfigDefinitionController@createForm')->name('admin.config_definitions.create');
Route::post('admin/config_definitions/create', 'Admin\ConfigDefinitionController@create');
Route::get('admin/config_definitions/read/{config_definition}', 'Admin\ConfigDefinitionController@read')->name('admin.config_definitions.read');
Route::get('admin/config_definitions/update/{config_definition}', 'Admin\ConfigDefinitionController@updateForm')->name('admin.config_definitions.update');
Route::patch('admin/config_definitions/update/{config_definition}', 'Admin\ConfigDefinitionController@update');
Route::delete('admin/config_definitions/delete/{config_definition}', 'Admin\ConfigDefinitionController@delete')->name('admin.config_definitions.delete');


// floors
Route::get('admin/floors', 'Admin\FloorController@index')->name('admin.floors');
Route::get('admin/floors/create', 'Admin\FloorController@createForm')->name('admin.floors.create');
Route::post('admin/floors/create', 'Admin\FloorController@create');
Route::get('admin/floors/read/{floor}', 'Admin\FloorController@read')->name('admin.floors.read');
Route::get('admin/floors/update/{floor}', 'Admin\FloorController@updateForm')->name('admin.floors.update');
Route::patch('admin/floors/update/{floor}', 'Admin\FloorController@update');
Route::delete('admin/floors/delete/{floor}', 'Admin\FloorController@delete')->name('admin.floors.delete');


// rooms
Route::get('admin/rooms', 'Admin\RoomController@index')->name('admin.rooms');
Route::get('admin/rooms/create', 'Admin\RoomController@createForm')->name('admin.rooms.create');
Route::post('admin/rooms/create', 'Admin\RoomController@create');
Route::get('admin/rooms/read/{room}', 'Admin\RoomController@read')->name('admin.rooms.read');
Route::get('admin/rooms/update/{room}', 'Admin\RoomController@updateForm')->name('admin.rooms.update');
Route::patch('admin/rooms/update/{room}', 'Admin\RoomController@update');
Route::delete('admin/rooms/delete/{room}', 'Admin\RoomController@delete')->name('admin.rooms.delete');



// categories
Route::get('admin/categories', 'Admin\CategoryController@index')->name('admin.categories');
Route::get('admin/categories/create', 'Admin\CategoryController@createForm')->name('admin.categories.create');
Route::post('admin/categories/create', 'Admin\CategoryController@create');
Route::get('admin/categories/read/{category}', 'Admin\CategoryController@read')->name('admin.categories.read');
Route::get('admin/categories/update/{category}', 'Admin\CategoryController@updateForm')->name('admin.categories.update');
Route::patch('admin/categories/update/{category}', 'Admin\CategoryController@update');
Route::delete('admin/categories/delete/{category}', 'Admin\CategoryController@delete')->name('admin.categories.delete');

// item_categories
Route::get('admin/item_categories', 'Admin\ItemCategoryController@index')->name('admin.item_categories');
Route::get('admin/item_categories/create', 'Admin\ItemCategoryController@createForm')->name('admin.item_categories.create');
Route::post('admin/item_categories/create', 'Admin\ItemCategoryController@create');
Route::get('admin/item_categories/read/{item_category}', 'Admin\ItemCategoryController@read')->name('admin.item_categories.read');
Route::get('admin/item_categories/update/{item_category}', 'Admin\ItemCategoryController@updateForm')->name('admin.item_categories.update');
Route::patch('admin/item_categories/update/{item_category}', 'Admin\ItemCategoryController@update');
Route::delete('admin/item_categories/delete/{item_category}', 'Admin\ItemCategoryController@delete')->name('admin.item_categories.delete');



// sales
Route::get('admin/sales', 'Admin\SaleController@index')->name('admin.sales');
Route::get('admin/sales/create', 'Admin\SaleController@createForm')->name('admin.sales.create');
Route::post('admin/sales/create', 'Admin\SaleController@create');
Route::get('admin/sales/read/{sale}', 'Admin\SaleController@read')->name('admin.sales.read');
Route::get('admin/sales/update/{sale}', 'Admin\SaleController@updateForm')->name('admin.sales.update');
Route::patch('admin/sales/update/{sale}', 'Admin\SaleController@update');
Route::delete('admin/sales/delete/{sale}', 'Admin\SaleController@delete')->name('admin.sales.delete');


// room_stocks
Route::get('admin/room_stocks', 'Admin\RoomStockController@index')->name('admin.room_stocks');
Route::get('admin/room_stocks/create', 'Admin\RoomStockController@createForm')->name('admin.room_stocks.create');
Route::post('admin/room_stocks/create', 'Admin\RoomStockController@create');
Route::get('admin/room_stocks/read/{room_stock}', 'Admin\RoomStockController@read')->name('admin.room_stocks.read');
Route::get('admin/room_stocks/update/{room_stock}', 'Admin\RoomStockController@updateForm')->name('admin.room_stocks.update');
Route::patch('admin/room_stocks/update/{room_stock}', 'Admin\RoomStockController@update');
Route::delete('admin/room_stocks/delete/{room_stock}', 'Admin\RoomStockController@delete')->name('admin.room_stocks.delete');

// stocks_computations
Route::get('admin/stocks_computations', 'Admin\StocksComputationController@index')->name('admin.stocks_computations');
Route::get('admin/stocks_computations/create', 'Admin\StocksComputationController@createForm')->name('admin.stocks_computations.create');
Route::post('admin/stocks_computations/create', 'Admin\StocksComputationController@create');
Route::get('admin/stocks_computations/read/{stocks_computation}', 'Admin\StocksComputationController@read')->name('admin.stocks_computations.read');
Route::get('admin/stocks_computations/update/{stocks_computation}', 'Admin\StocksComputationController@updateForm')->name('admin.stocks_computations.update');
Route::patch('admin/stocks_computations/update/{stocks_computation}', 'Admin\StocksComputationController@update');
Route::delete('admin/stocks_computations/delete/{stocks_computation}', 'Admin\StocksComputationController@delete')->name('admin.stocks_computations.delete');