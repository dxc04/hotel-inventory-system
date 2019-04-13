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
    Route::get('post-a-sale', 'Api\AppController@postASale');
    Route::get('post-no-sale', 'Api\AppController@postNoSale');
    Route::get('post-dnd-due-out', 'Api\AppController@postDNDDueOut');
    Route::get('post-dnd-stayover', 'Api\AppController@postDNDStayover');
    Route::get('post-extra-sale', 'Api\AppController@postExtraSale');
    Route::get('post-restock', 'Api\AppController@postRestock');
});


//Route::get('test', function(){
//    return response([1,2,3,4],200);   
//});
