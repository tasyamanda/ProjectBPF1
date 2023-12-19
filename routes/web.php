<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PegawaiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('template/master');
});
Route::resource('buku', BukuController::class);
Route::resource('pegawai', PegawaiController::class);
Route::delete('/buku/{id}', 'BukuController@destroy')->name('buku.destroy');
// Rute untuk menampilkan formulir update
Route::get('/buku/{id}/edit', 'BukuController@edit')->name('buku.edit');

// Rute untuk memproses update data
Route::put('/buku/{id}', 'BukuController@update')->name('buku.update');
// Rute untuk menampilkan formulir update
Route::get('/pegawai/{id}/edit', 'pegawaiController@edit')->name('pegawai.edit');

// Rute untuk memproses update data
Route::put('/pegawai/{id}', 'pegawaiController@update')->name('pegawai.update');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
