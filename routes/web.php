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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

//Loker
Route::get('/loker', 'LokerController@index');
Route::post('/insert_loker', 'LokerController@insert');
Route::post('/edit_loker/{id}', 'LokerController@edit');
Route::get('/delete_loker/{id}', 'LokerController@delete');

//Lamaran
Route::get('/lamaran', 'LamaranController@index');
Route::post('/insert_lamaran', 'LamaranController@insert');
Route::post('/edit_lamaran/{id}', 'LamaranController@edit');
Route::get('/delete_lamaran/{id}', 'LamaranController@delete');

//Absensi
Route::get('/absensi', 'AbsensiController@index');
Route::post('/insert_absensi', 'AbsensiController@insert');
Route::post('/edit_absensi/{id}', 'AbsensiController@edit');
Route::get('/delete_absensi/{id}', 'AbsensiController@delete');

//Penilaian
Route::get('/penilaian', 'PenilaianController@index');
Route::post('/insert_penilaian', 'PenilaianController@insert');
Route::post('/edit_penilaian/{id}', 'PenilaianController@edit');
Route::get('/delete_penilaian/{id}', 'PenilaianController@delete');

//Cuti
Route::get('/cuti', 'CutiController@index');
Route::get('/cuti/setuju/{id}', 'CutiController@setuju');
Route::get('/cuti/tolak/{id}', 'CutiController@tolak');
Route::post('/insert_cuti', 'CutiController@insert');
Route::post('/edit_cuti/{id}', 'CutiController@edit');
Route::get('/delete_cuti/{id}', 'CutiController@delete');

//Izin
Route::get('/izin', 'IzinController@index');
Route::get('/izin/setuju/{id}', 'IzinController@setuju');
Route::get('/izin/tolak/{id}', 'IzinController@tolak');
Route::post('/insert_izin', 'IzinController@insert');
Route::post('/edit_izin/{id}', 'IzinController@edit');
Route::get('/delete_izin/{id}', 'IzinController@delete');

//SP
Route::get('/sp', 'SpController@index');
Route::post('/insert_sp', 'SpController@insert');
Route::post('/edit_sp/{id}', 'SpController@edit');
Route::get('/delete_sp/{id}', 'SpController@delete');

//Pengunduran
Route::get('/pengunduran', 'PengunduranController@index');
Route::get('/pengunduran/setuju/{id}', 'PengunduranController@setuju');
Route::get('/pengunduran/tolak/{id}', 'PengunduranController@tolak');
Route::post('/insert_pengunduran', 'PengunduranController@insert');
Route::post('/edit_pengunduran/{id}', 'PengunduranController@edit');
Route::get('/delete_pengunduran/{id}', 'PengunduranController@delete');

//PHK
Route::get('/phk', 'PhkController@index');
Route::post('/insert_phk', 'PhkController@insert');
Route::post('/edit_phk/{id}', 'PhkController@edit');
Route::get('/delete_phk/{id}', 'PhkController@delete');

//Demosi
Route::get('/demosi', 'DemosiController@index');
Route::post('/insert_demosi', 'DemosiController@insert');
Route::post('/edit_demosi/{id}', 'DemosiController@edit');
Route::get('/delete_demosi/{id}', 'DemosiController@delete');

//Mutasi
Route::get('/mutasi', 'MutasiController@index');
Route::post('/insert_mutasi', 'MutasiController@insert');
Route::post('/edit_mutasi/{id}', 'MutasiController@edit');
Route::get('/delete_mutasi/{id}', 'MutasiController@delete');

//Gaji
Route::get('/gaji', 'GajiController@index');
Route::post('/insert_gaji', 'GajiController@insert');
Route::post('/edit_gaji/{id}', 'GajiController@edit');
Route::get('/delete_gaji/{id}', 'GajiController@delete');

//-----------------------------------------------------------------//
//Karyawan
Route::get('/karyawan', 'KaryawanController@index');
Route::post('/insert_karyawan', 'KaryawanController@insert');
Route::post('/edit_karyawan/{id}', 'KaryawanController@edit');
Route::get('/delete_karyawan/{id}', 'KaryawanController@delete');

//Pengguna
Route::get('/pengguna', 'PenggunaController@index');
Route::post('/insert_pengguna', 'PenggunaController@insert');
Route::post('/edit_pengguna/{id}', 'PenggunaController@edit');
Route::get('/delete_pengguna/{id}', 'PenggunaController@delete');

