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

Route::group(['middleware' => ['auth:api','api:api','isadmin:api']], function () {
    
    Route::get('barang', 'BarangController@index');
    Route::get('formbarang', 'BarangController@add');
    Route::post('barang', 'BarangController@store');
    Route::get('formbarang/{id}', 'BarangController@edit');
    Route::post('barang/{id}', 'BarangController@destroy');
    Route::get('barangsync/{updated_at}', 'BarangController@sync');
    
    Route::get('kategoribarang', 'KategoribarangController@index');
    Route::post('kategoribarang', 'KategoribarangController@store');
    Route::get('formkategoribarang', 'KategoribarangController@add');
    Route::get('formkategoribarang/{id}', 'KategoribarangController@edit');
    Route::post('kategoribarang/{id}', 'KategoribarangController@destroy');
    
});