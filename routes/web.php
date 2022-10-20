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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\LoginController;

//LOGIN
Route::get('/', function () {
    return redirect('login');
});
//Autentikasi Login di false supaya tidak keluar register
Auth::routes(['register' => true]);
//Auth::routes();

Route::get('/home', 'HomeController@index')->name('Home');

Route::prefix('Home')->middleware('auth')->group(function () {
    Route::get('Profile', 'HomeController@profile')->name('Home/Profile');
    Route::delete('Profile/Delete', 'HomeController@del')->name('Home/Profile/Delete');
    Route::get('Profile/ChangePassword', 'HomeController@changepassword')->name('Home/Profile/ChangePassword');
    Route::patch('Profile/ChangePassword', 'HomeController@storepass');
    Route::get('Profile/Edit', 'HomeController@showedit')->name('Home/Profile/Edit');
    Route::patch('Profile/Edit', 'HomeController@storeedit');
});

Route::prefix('Admin')->middleware('auth')->group(function () {
    Route::get('Show', 'HomeController@show')->name('Admin/Show');
    Route::get('CreateUser', 'HomeController@create')->name('Admin/CreateUser');
    Route::post('CreateUser', 'HomeController@store');
    Route::get('Show/{nis_nip}', 'HomeController@showuser');
    Route::get('Show/{nis_nip}/ChangePassword', 'HomeController@changepass');
    Route::patch('Show/{nis_nip}/ChangePassword', 'HomeController@storechangepass');
    Route::get('Show/{nis_nip}/Edit', 'HomeController@showedituser');
    Route::patch('Show/{nis_nip}/Edit', 'HomeController@storeedituser');
    Route::delete('Show/{nis_nip}/Delete', 'HomeController@deluser');
});

Route::prefix('Barang')->middleware('auth')->group(function () {
    Route::get('/', 'BarangController@index')->name('Barang');
    Route::get('/{id}/Tambah', 'BarangController@tambah');
    Route::post('/{id}/Tambah', 'BarangController@storetambah');
    Route::get('/{id}/Edit', 'BarangController@editbarang');
    Route::patch('/{id}/Edit', 'BarangController@storeeditbarang');
    Route::delete('/{id}/Delete', 'BarangController@deletebarang');
});

Route::prefix('Perbaikan')->middleware('auth')->group(function () {
    Route::get('/', 'PerbaikanController@index')->name('Perbaikan');
    Route::get('/{id}/Tambah', 'PerbaikanController@tambah');
    Route::post('/{id}/Tambah', 'PerbaikanController@storetambah');
    Route::delete('/{id}/Delete', 'PerbaikanController@deleteperbaikan');
});

Route::prefix('Pengajuan')->middleware('auth')->group(function () {
    Route::get('/', 'PengajuanController@index')->name('Pengajuan');
    Route::get('/{id}/Tambah', 'PengajuanController@tambah');
    Route::post('/{id}/Tambah', 'PengajuanController@storetambah');
    Route::get('/{id}/Edit', 'PengajuanController@editpengajuan');
    Route::patch('/{id}/Edit', 'PengajuanController@storeeditpengajuan');
    Route::delete('/{id}/Delete', 'PengajuanController@deletepengajuan');
});

Route::prefix('Peminjaman')->middleware('auth')->group(function () {
    Route::get('/', 'PeminjamanController@index')->name('Peminjaman');
    Route::get('/{id}/Tambah', 'PeminjamanController@tambah');
    Route::post('/{id}/Tambah', 'PeminjamanController@storetambah');
    Route::get('/{id}/Edit', 'PeminjamanController@editpeminjaman');
    Route::patch('/{id}/Edit', 'PeminjamanController@storeeditpeminjaman');
    Route::delete('/{id}/Delete', 'PengajuanController@deletepeminjaman');
});

Route::prefix('Jadwal')->middleware('auth')->group(function () {
    Route::get('/', 'JadwalController@index')->name('Jadwal');
    Route::get('/{id}/Tambah', 'JadwalController@tambah');
    Route::post('/{id}/Tambah', 'JadwalController@storetambah');
    Route::get('/{id}/Edit', 'JadwalController@editjadwal');
    Route::patch('/{id}/Edit', 'JadwalController@storeeditjadwal');
    Route::delete('/{id}/Delete', 'JadwalController@deletejadwal');
});

Route::prefix('Cetak')->middleware('auth')->group(function () {
    Route::get('/Barang', 'CetakController@index')->name('CetakBarang');
    Route::get('/Jadwal', 'CetakController@index')->name('CetakJadwal');
    Route::get('/Peminjaman', 'CetakController@index')->name('CetakPeminjaman');
    Route::get('/Pengajuan', 'CetakController@index')->name('CetakPengajuan');
    Route::get('/Perbaikan', 'CetakController@index')->name('CetakPerbaikan');
    Route::get('/Barang/{id}', 'CetakController@barang');
    Route::get('/Jadwal/{id}', 'CetakController@jadwal');
    Route::get('/Peminjaman/{id}', 'CetakController@peminjaman');
    Route::get('/Pengajuan/{id}', 'CetakController@pengajuan');
    Route::get('/Perbaikan/{id}', 'CetakController@perbaikan');
});