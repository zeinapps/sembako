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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/suka', 'Eshop\AkunController@suka');
    Route::post('/tidaksuka', 'Eshop\AkunController@tidaksuka');
});

//Route::group([ 'middleware' => []], function () {
//    Route::get('produk', 'Eshop\ProdukController@apiindex');
//    Route::get('produk/{id}', 'Eshop\ProdukController@apidetil');
//});