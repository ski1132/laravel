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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
                    // insert "/api/" before every URL !!!!
Route::get('/product','Api\ProductControllerApi@product_list');
Route::get('/product/{category_id?}','Api\ProductControllerApi@product_list');
Route::post('/product/search','Api\ProductControllerApi@product_search');
Route::get('/category','Api\CategoryControllerApi@category_list');
Route::get('/product/chart/list','Api\ProductControllerApi@get_product_chart');
Route::get('/category/chart/list','Api\ProductControllerApi@get_Category_chart');

