<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KompetensiController;

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

// HOME
Route::get('/', function () {
    $totalSiswa = \App\Models\Siswa::count();
    $totalPerusahaan = \App\Models\Perusahaan::count();
    $siswaAktif = \App\Models\Siswa::whereHas('perusahaan')->count();
    $totalKompetensi = \App\Models\Kompetensi::count();
    return view('home', compact('totalSiswa', 'totalPerusahaan', 'siswaAktif', 'totalKompetensi'));
})->name('home');

Route::get('/up', function () {
    return true;
});

// PERUSAHAAN
Route::resource('perusahaan', PerusahaanController::class);

// SISWA
Route::resource('siswa', SiswaController::class)->parameters([
    'siswa' => 'nis',
]);

// KOMPETENSI
Route::resource('kompetensi', KompetensiController::class);
