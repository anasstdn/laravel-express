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
    // return view('welcome');
    if (Auth::check()) {
        return redirect('home');
    } else {
        return redirect('login');
    }
});

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('user')->group(function() {
    Route::get('/', 'UserController@index');
    Route::get('/create', 'UserController@create');
    Route::post('/simpan', 'UserController@store');
    Route::match(['get', 'post'],'/{id}/edit','UserController@edit');
    Route::post('/update/{id}','UserController@update');
    Route::delete('/{id}', 'UserController@destroy');
});

Route::prefix('pegawai')->group(function() {
    Route::get('/', 'PegawaiController@index');
    Route::get('/create', 'PegawaiController@create');
    Route::post('/simpan', 'PegawaiController@store');
    Route::match(['get', 'post'],'/{id}/edit','PegawaiController@edit');
    Route::post('/update/{id}','PegawaiController@update');
    Route::get('/{id}/disable', 'PegawaiController@disable');
    Route::get('/{id}/activate', 'PegawaiController@activate');
    Route::delete('/{id}', 'PegawaiController@destroy');
});

Route::prefix('region')->group(function() {
    Route::get('/', 'RegionController@index');
    Route::get('/create', 'RegionController@create');
    Route::post('/simpan', 'RegionController@store');
    Route::match(['get', 'post'],'/{id}/edit','RegionController@edit');
    Route::post('/update/{id}','RegionController@update');
    Route::delete('/{id}', 'RegionController@destroy');
});

Route::prefix('tarif')->group(function() {
    Route::get('/', 'TarifController@index');
    Route::get('/create', 'TarifController@create');
    Route::post('/simpan', 'TarifController@store');
    Route::match(['get', 'post'],'/{id}/edit','TarifController@edit');
    Route::post('/update/{id}','TarifController@update');
    Route::delete('/{id}', 'TarifController@destroy');
});

Route::prefix('barang')->group(function() {
    Route::get('/', 'BarangController@index');
    Route::get('/{id}/kirim', 'BarangController@kirim');
    Route::get('/create', 'BarangController@create');
    Route::post('/simpan', 'BarangController@store');
    Route::match(['get', 'post'],'/{id}/edit','BarangController@edit');
    Route::match(['get', 'post'],'/get-kecamatan','BarangController@getKecamatan');
    Route::match(['get', 'post'],'/get-kelurahan','BarangController@getKelurahan');
    Route::post('/update/{id}','BarangController@update');
    Route::post('/kirim-barang', 'BarangController@kirimBarang');
    Route::get('/cetak-print/{data}', 'BarangController@cetakPrint');
    Route::get('/index-transit', 'BarangController@indexTransit');
    Route::get('/index-terkirim', 'BarangController@indexTerkirim');
    Route::get('/{id}/transit', 'BarangController@transit');
    Route::post('/update-transit', 'BarangController@updateTransit');
    Route::delete('/{id}', 'BarangController@destroy');
});

Route::prefix('kurir')->group(function() {
    Route::get('/', 'KurirController@index');
    Route::get('/create', 'KurirController@create');
    Route::post('/simpan', 'KurirController@store');
    Route::match(['get', 'post'],'/{id}/edit','KurirController@edit');
    Route::post('/update/{id}','KurirController@update');
    Route::get('/{id}/disable', 'KurirController@disable');
    Route::get('/{id}/activate', 'KurirController@activate');
    Route::delete('/{id}', 'KurirController@destroy');
});

Route::prefix('pengiriman-barang')->group(function() {
    Route::get('/', 'PengirimanBarangController@index');
    Route::get('/index-otw', 'PengirimanBarangController@indexOtw');
    Route::get('/index-delayed', 'PengirimanBarangController@indexDelayed');
    Route::get('/index-terkirim', 'PengirimanBarangController@indexTerkirim');
    Route::get('/{id}/ambil-pengiriman', 'PengirimanBarangController@ambilPengiriman');
    Route::post('/simpan', 'PengirimanBarangController@store');
    Route::match(['get', 'post'],'/{id}/edit','PengirimanBarangController@edit');
    Route::post('/update/{id}','PengirimanBarangController@update');
    Route::delete('/{id}', 'PengirimanBarangController@destroy');
});

Route::prefix('cek-lokasi-barang')->group(function() {
    Route::get('/', 'CekLokasiBarangController@index');
    Route::get('/{id}/ambil-pengiriman', 'CekLokasiBarangController@ambilPengiriman');
    Route::get('/{id}/{status}', 'CekLokasiBarangController@confirmation');
    Route::post('/simpan', 'CekLokasiBarangController@store');
    Route::post('/cari', 'CekLokasiBarangController@cari');
    Route::match(['get', 'post'],'/{id}/edit','CekLokasiBarangController@edit');
    Route::post('/update/{id}','CekLokasiBarangController@update');
    Route::delete('/{id}', 'CekLokasiBarangController@destroy');
});

Route::prefix('laporan-barang')->group(function() {
    Route::get('/', 'LaporanBarangController@index');
    Route::get('/user', 'LaporanBarangController@user');
    Route::get('/pegawai', 'LaporanBarangController@pegawai');
    Route::get('/pegawai/{id}', 'LaporanBarangController@pegawaiStatus');
    Route::get('/kurir', 'LaporanBarangController@kurir');
     Route::get('/kurir/{id}', 'LaporanBarangController@kurirStatus');
    Route::get('/{status}', 'LaporanBarangController@status');
    Route::post('/search', 'LaporanBarangController@search');
});
