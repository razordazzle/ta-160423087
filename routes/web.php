<?php

use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\RekomendasiRuteController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CariRekomendasiController;

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/cari-rekomendasi/lokasi',[CariRekomendasiController::class,'lokasiForm'])->name('cari-rekomendasi.lokasi');
Route::post('/cari-rekomendasi/lokasi',[CariRekomendasiController::class,'lokasiStore'])->name('cari-rekomendasi.lokasi.store');

Route::get('/cari-rekomendasi/preferensi',[CariRekomendasiController::class,'preferensiForm'])->name('cari-rekomendasi.preferensi');
Route::post('/cari-rekomendasi/preferensi',[CariRekomendasiController::class,'preferensiStore'])->name('cari-rekomendasi.preferensi.store');

Route::get('/cari-rekomendasi/fasilitas',[CariRekomendasiController::class,'fasilitasForm'])->name('cari-rekomendasi.fasilitas');
Route::post('/cari-rekomendasi/fasilitas',[CariRekomendasiController::class,'fasilitasStore'])->name('cari-rekomendasi.fasilitas.store');
Route::get('/cari-rekomendasi/perbandingan',[CariRekomendasiController::class,'perbandinganForm'])->name('cari-rekomendasi.perbandingan');
Route::post('/cari-rekomendasi/perbandingan',[CariRekomendasiController::class,'perbandinganStore'])->name('cari-rekomendasi.perbandingan.store');

Route::get('/cari-rekomendasi/hasil',[CariRekomendasiController::class,'hasilShow'])->name('cari-rekomendasi.hasil');

Route::post('/wishlist/tambah/{destinasi}',[WishlistController::class,'tambah'])->name('wishlist.tambah');
Route::get('/wishlist',[WishlistController::class,'index'])->name('wishlist.index');
Route::delete('/wishlist/{destinasi}',[WishlistController::class,'hapus'])->name('wishlist.hapus');
Route::get('/rekomendasi-rute',[RekomendasiRuteController::class,'index'])->name('rekomendasi-rute.index');

Route::get('/registrasi',[RegistrasiController::class,'form'])->name('registrasi.form');
Route::post('/registrasi',[RegistrasiController::class,'store'])->name('registrasi.store');
Route::get('/login',[LoginController::class,'form'])->name('login.form');
Route::post('/login',[LoginController::class,'store'])->name('login.store');

Route::get('/destinasi',[DestinasiController::class,'index'])->name('destinasi.index');
Route::get('/destinasi/{destinasi}',[DestinasiController::class,'show'])->name('destinasi.show');