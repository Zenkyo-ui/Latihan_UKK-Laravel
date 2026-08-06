<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\SiswaController;


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

Route::view('/', 'home')->name('home');

Route::get('/tentang', function () {
    return 'Halaman ini berisi informasi tentang modul E-PKL sekolah.';
});

Route::get('/kontak', function () {
    return 'Hubungi guru pembimbing PKL di ruang RPL.';
});

Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/{nis}', [SiswaController::class, 'show'])->name('siswa.show');

Route::get('/perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan.index');
Route::get('/perusahaan/{id}', [PerusahaanController::class, 'show'])->name('perusahaan.show');
