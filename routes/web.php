<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'Eshop\HomeController@index');
Route::get('produk', 'Eshop\ProdukController@index');
Route::get('produk/{id}', 'Eshop\ProdukController@show');
Route::get('kategori/{id}', 'Eshop\ProdukController@kategori');
Route::get('keranjang', 'Eshop\ProdukController@keranjang');

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::group(['middleware' => ['auth','isadmin']], function () {
     
    Route::get('/kategoribarang', 'KategoribarangController@index');
    Route::post('/kategoribarang', 'KategoribarangController@store');
    Route::get('/formkategoribarang', 'KategoribarangController@add');
    Route::get('/formkategoribarang/{id}', 'KategoribarangController@edit');
    Route::post('/kategoribarang/{id}', 'KategoribarangController@destroy');


    Route::get('/barang', 'BarangController@index');
    Route::get('/formbarang', 'BarangController@add');
    Route::post('/barang', 'BarangController@store');
    Route::get('/formbarang/{id}', 'BarangController@edit');
    Route::post('/barang/{id}', 'BarangController@destroy');
});

