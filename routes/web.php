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

Route::get('/nut/{name?}/{surname?}/{age?}', function ($name,$surname,$age) {
    return view('test', array(
        'name' => $name,
        'surname' => $surname,
        'age' => $age,
    )

    );
});
// Route::get('/', function () {
//     return view('layouts.master');
// });
Route::get('/', function () {
    return view('test');
});

//after Midterm
Route::get('/home','HomeController@index')->name('home');

Route::get('/cart/view','CartController@viewCart');
Route::get('/cart/add/{id}','CartController@addToCart');
Route::get('/cart/update/{id}/{qty}','CartController@updateCart');
Route::get('/cart/delete/{id}','CartController@deleteCart');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'product','middleware' => 'auth'], function()
{
    Route::get('/', 'ProductController@index' );
    Route::get('/edit/{id?}', 'ProductController@edit' );
    Route::post('/update', 'ProductController@update' );
    Route::post('/insert', 'ProductController@insert' );
    Route::get('/remove/{id}', 'ProductController@remove');
    Route::post('/search', 'ProductController@search');
    Route::get('/search', 'ProductController@search');
});
Route::get('/redirect','SocialAuthController@redirect');
Route::get('/callback','SocialAuthController@callback');
Route::get('/logout', 'ProductController@logout' );