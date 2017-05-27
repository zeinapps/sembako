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
Route::get('carapembelian', function () { return view('eshop/carapembelian'); });
Route::get('kontak', function () { return view('eshop/kontak'); });

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
    
    Route::get('/user', 'UserController@index');
    Route::post('/user', 'UserController@store');
    Route::get('/formuser', 'UserController@add');
    Route::get('/formuser/{id}', 'UserController@edit');
    Route::post('/user/{id}', 'UserController@destroy');
    Route::post('/reset', 'UserController@reset');
    Route::get('/formreset/{id}', 'UserController@resetform');
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/penjualan', 'Eshop\PenjualanController@store');
    Route::post('/ubahakun', 'Eshop\AkunController@store');
    Route::post('/ubahpwd', 'Eshop\AkunController@storepwd');
    Route::get('/akunubahpwd', 'Eshop\AkunController@ubahpwd');
    Route::get('/akun', 'Eshop\AkunController@show');
    Route::get('/kesukaan', 'Eshop\AkunController@kesukaan');
    Route::get('/transaksi', 'Eshop\PenjualanController@index');
    Route::get('/transaksi/{id}', 'Eshop\PenjualanController@show');
});

