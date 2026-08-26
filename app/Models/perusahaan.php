<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * MODEL PERUSAHAAN
 * ================
 * Model ini merepresentasikan tabel 'perusahaans' di database.
 * Setiap baris = 1 perusahaan mitra PKL.
 *
 * RELASI:
 * - Perusahaan hasMany Siswa (satu perusahaan punya banyak siswa)
 *
 * CONTOH PENGGUNAAN:
 *   $perusahaan = Perusahaan::find(1);
 *   $perusahaan->siswa;              // collection berisi semua siswa di perusahaan ini
 *   $perusahaan->siswa_count;        // jumlah siswa (kalau pakai withCount)
 *   $perusahaan->kuota - $perusahaan->siswa_count;  // sisa kuota
 */
class Perusahaan extends Model
{
    use HasFactory;

    /**
     * $fillable = kolom yang BOLEH diisi massal.
     * Kalau tidak ada di sini, Siswa::create() akan abaikan kolom ini.
     */
    protected $fillable = [
        'nama_perusahaan',           // Nama PT/CV
        'bidang_usaha',              // Bidang usaha (IT, Manufaktur, dll)
        'alamat',                    // Alamat lengkap
        'nama_pembimbing_industri',  // Nama pembimbing di perusahaan
        'telepon',                   // Nomor telepon
        'kuota',                     // Maksimal siswa yang bisa diterima
    ];

    /**
     * RELASI: Perusahaan → Siswa (1:N)
     * =================================
     * "Saya (perusahaan) punya BANYAK siswa"
     *
     * hasMany artinya FK ada di TABEL LAIN (siswas).
     * Parameter kedua 'perusahaan_id' = nama kolom FK di tabel siswas.
     *
     * Kalau perusahaan id = 1, maka siswa yang punya perusahaan_id = 1
     * adalah siswa-siswa saya.
     *
     * CARA PAKAI:
     *   $perusahaan->siswa             // collection semua siswa
     *   $perusahaan->siswa_count       // jumlah (kalau pakai withCount)
     *   $perusahaan->siswa()->where('kelas', 'XII PPLG 1')->get();  // filter
     */
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'perusahaan_id');
    }
}
