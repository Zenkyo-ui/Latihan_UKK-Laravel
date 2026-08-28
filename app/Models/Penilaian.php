<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * MODEL PENILAIAN
 * ================
 * Model ini merepresentasikan tabel 'penilaians' di database.
 * Setiap baris = 1 penilaian hasil PKL siswa di perusahaan.
 *
 * KONSEP:
 * Penilaian ini adalah lapisan LEBIH DALAM dari kompetensi (jurusan).
 * Kalau kompetensi = "bidang keahlian siswa", maka penilaian =
 * "seberapa bagus kompetensi siswa saat PKL di perusahaan".
 *
 * RELASI:
 * - Penilaian belongsTo Siswa (satu penilaian milik 1 siswa)
 *   Perusahaan diakses lewat: $penilaian->siswa->perusahaan
 *
 * CONTOH PENGGUNAAN:
 *   $p = Penilaian::with('siswa.perusahaan')->find(1);
 *   $p->skor;                       // 85
 *   $p->siswa->nama;                // "Budi Santoso"
 *   $p->siswa->perusahaan->nama_perusahaan;  // "PT Sinergi"
 */
class Penilaian extends Model
{
    use HasFactory;

    /**
     * $fillable = kolom yang BOLEH diisi massal via Penilaian::create([...])
     */
    protected $fillable = [
        'tanggal_penilaian',      // Tanggal penilaian dilakukan
        'siswa_id',               // FK → tabel siswas
        'skor',                   // Nilai angka 0-100
        'status_penguasaan',      // Sangat Mahir/Mahir/Cukup/Kurang/Belum Dikuasai
        'keaktifan',              // Sangat Baik/Baik/Cukup/Kurang
        'sikap',                  // Sangat Baik/Baik/Cukup/Kurang
        'status_tamat',           // Lulus/Tidak Lulus
        'catatan',                // Catatan dari perusahaan
    ];

    /**
     * RELASI: Penilaian → Siswa
     * ==========================
     * "Saya (penilaian) milik 1 siswa"
     *
     * belongsTo artinya FK (siswa_id) ada di TABEL SAYA (penilaians).
     *
     * CARA PAKAI:
     *   $penilaian->siswa               // object Siswa
     *   $penilaian->siswa->nama         // nama siswa
     *   $penilaian->siswa->perusahaan   // perusahaan tempat PKL
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
