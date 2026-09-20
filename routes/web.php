<?php

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