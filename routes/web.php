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

// HOME
Route::get('/', function () {
    $totalSiswa = \App\Models\siswa::count();
    $totalPerusahaan = \App\Models\perusahaan::count();
    $siswaAktif = \App\Models\siswa::whereHas('perusahaan')->count();
    return view('home', compact('totalSiswa', 'totalPerusahaan', 'siswaAktif'));
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
