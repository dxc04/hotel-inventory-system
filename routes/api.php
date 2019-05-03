<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
    Route::post('post-a-sale', 'Api\AppController@postASale');
    Route::post('post-no-sale', 'Api\AppController@postNoSale');
    Route::post('post-dnd-due-out', 'Api\AppController@postDNDDueOut');
    Route::post('post-dnd-stayover', 'Api\AppController@postDNDStayover');
    Route::post('post-an-item-reject', 'Api\AppController@postAnItemReject');
    Route::post('post-an-extra-sale', 'Api\AppController@postAnExtraSale');
    Route::post('post-a-restock', 'Api\AppController@postARestock');
    Route::get('get-allthedata', 'Api\AppController@getAllthedata');
});


//Route::get('test', function(){
//    return response([1,2,3,4],200);   
//});
