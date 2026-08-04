<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerusahaanController;


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
 return 'Selamat datang di Sistem E-PKL';
});

Route::get('/tentang', function () {
 return 'Halaman ini berisi informasi tentang modul E-PKL sekolah.';
});

Route::get('/kontak', function () {
 return 'Hubungi guru pembimbing PKL di ruang RPL.';
});

Route::get('/siswa/{nis}', function ($nis) {
 return 'Detail siswa PKL dengan NIS: ' . $nis;
});

Route::get('/perusahaan/{id?}', function ($id = null) {
 return $id ? "Detail perusahaan ID: $id" : 'Silakan pilih perusahaan.';
});

Route::get('/siswa', function () {
 return 'Daftar siswa PKL';
})->name('siswa.index');

Route::prefix('perusahaan')->name('perusahaan.')->group(function () {
 Route::get('/', function () {
 return 'Daftar semua perusahaan mitra PKL';
 })->name('index');
 Route::get('/{id}', function ($id) {
 return 'Detail perusahaan ID: ' . $id;
 })->name('show');
});