<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\PenilaianController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| File ini adalah PETA APLIKASI.
| Setiap URL yang diketik di browser akan dicocokkan di sini.
|
| Flow-nya:
| 1. User buka URL → browser kirim request
| 2. Laravel cek file ini → cari route yang cocok
| 3. Route arahkan ke closure / controller method
| 4. Controller proses data → kirim ke view
| 5. View render HTML → kirim ke browser
|
*/

// =========================================================================
// HOME / DASHBOARD
// =========================================================================
// Route::get('/', ...) = handle request GET ke halaman utama (domain/)
//
// Closure function di sini artinya kode dijalankan langsung tanpa controller.
// Cocok untuk halaman sederhana.
//
// ->name('home') = kasih nama route, supaya bisa dipanggil:
//   route('home') → "/"
//
// Yang dikirim ke view:
//   $totalSiswa      = jumlah total siswa
//   $totalPerusahaan = jumlah total perusahaan
//   $siswaAktif      = siswa yang sudah punya perusahaan
//   $totalKompetensi = jumlah kompetensi
//   $totalPenilaian  = jumlah penilaian yang sudah diinput
Route::get('/', function () {
    $totalSiswa = \App\Models\Siswa::count();
    $totalPerusahaan = \App\Models\Perusahaan::count();
    $siswaAktif = \App\Models\Siswa::whereHas('perusahaan')->count();
    $totalKompetensi = \App\Models\Kompetensi::count();
    $totalPenilaian = \App\Models\Penilaian::count();
    return view('home', compact('totalSiswa', 'totalPerusahaan', 'siswaAktif', 'totalKompetensi', 'totalPenilaian'));
})->name('home');

// Route health check — untuk cek apakah Laravel berjalan
Route::get('/up', function () {
    return true;
});

// =========================================================================
// RESOURCE ROUTES
// =========================================================================
//
// Route::resource() = shortcut untuk membuat 7 route CRUD sekaligus:
//
// | Method   | URL                    | Controller Method | Kegunaan        |
// |----------|------------------------|-------------------|-----------------|
// | GET      | /perusahaan            | index()           | Lihat semua     |
// | GET      | /perusahaan/create     | create()          | Form tambah     |
// | POST     | /perusahaan            | store()           | Simpan baru     |
// | GET      | /perusahaan/{id}       | show()            | Lihat detail    |
// | GET      | /perusahaan/{id}/edit  | edit()            | Form edit       |
// | PUT      | /perusahaan/{id}       | update()          | Simpan edit     |
// | DELETE   | /perusahaan/{id}       | destroy()         | Hapus data      |
//

// PERUSAHAAN — parameter pakai ID default (angka)
Route::resource('perusahaan', PerusahaanController::class);

// SISWA — parameter route diganti dari '{siswa}' jadi '{nis}'
// Artinya URL: /siswa/22231001 (bukan /siswa/1)
// Parameter kedua method controller akan berisi NIS, bukan ID.
Route::resource('siswa', SiswaController::class)->parameters([
    'siswa' => 'nis',
]);

// KOMPETENSI — parameter pakai ID default
Route::resource('kompetensi', KompetensiController::class);

// PENILAIAN — parameter pakai ID default
// Menilai hasil PKL siswa di perusahaan (lapisan lebih dalam dari kompetensi)
Route::resource('penilaian', PenilaianController::class);
