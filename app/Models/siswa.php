<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * MODEL SISWA
 * ===========
 * Model ini merepresentasikan tabel 'siswas' di database.
 * Setiap baris di tabel = 1 siswa yang melaksanakan PKL.
 *
 * RELASI:
 * - Siswa belongsTo Perusahaan (satu siswa punya 1 perusahaan mitra)
 * - Siswa belongsTo Kompetensi (satu siswa punya 1 bidang keahlian)
 *
 * CONTOH PENGGUNAAN:
 *   $siswa = Siswa::find(1);
 *   $siswa->perusahaan->nama_perusahaan;  // "PT Sinergi"
 *   $siswa->kompetensi->nama_kompetensi;  // "PPLG"
 */
class Siswa extends Model
{
    use HasFactory;

    /**
     * $fillable = kolom yang BOLEH diisi massal via Siswa::create([...])
     * Tanpa ini, Laravel akan blokir mass assignment untuk keamanan.
     */
    protected $fillable = [
        'nis',                 // Nomor Induk Siswa (unique)
        'nama',                // Nama lengkap siswa
        'kelas',               // Kelas (contoh: "XII PPLG 1")
        'tanggal_mulai_pkl',   // Tanggal mulai PKL
        'tanggal_selesai_pkl', // Tanggal selesai PKL
        'perusahaan_id',       // FK → tabel perusahaans (perusahaan mana yang dituju)
        'kompetensi_id',       // FK → tabel kompetensis (bidang keahlian siswa)
    ];

    /**
     * RELASI: Siswa → Perusahaan
     * ===========================
     * "Saya (siswa) bekerja di 1 perusahaan"
     *
     * belongsTo artinya FK ada di TABEL SAYA (siswas).
     * Parameter kedua 'perusahaan_id' = nama kolom FK di tabel siswas.
     *
     * Kalau saya punya perusahaan_id = 3, berarti saya di PT ke-3.
     *
     * CARA PAKAI:
     *   $siswa->perusahaan  // mengembalikan object Perusahaan
     *   $siswa->perusahaan->nama_perusahaan  // "PT Sinergi"
     */
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }

    /**
     * RELASI: Siswa → Kompetensi
     * ===========================
     * "Saya (siswa) punya 1 bidang keahlian (PPLG, TKJ, dll)"
     *
     * belongsTo artinya FK ada di TABEL SAYA (siswas).
     * Laravel otomatis cari kolom 'kompetensi_id' di tabel siswas.
     *
     * CARA PAKAI:
     *   $siswa->kompetensi  // mengembalikan object Kompetensi
     *   $siswa->kompetensi->nama_kompetensi  // "PPLG"
     */
    public function kompetensi()
    {
        return $this->belongsTo(Kompetensi::class);
    }

    /**
     * RELASI: Siswa → Penilaian (1:1)
     * ================================
     * "Saya (siswa) punya 1 penilaian hasil PKL di perusahaan"
     *
     * hasOne artinya FK (siswa_id) ada di TABEL LAIN (penilaians).
     *
     * CARA PAKAI:
     *   $siswa->penilaian            // object Penilaian (atau null kalau belum dinilai)
     *   $siswa->penilaian->skor      // skor penilaian
     */
    public function penilaian()
    {
        return $this->hasOne(Penilaian::class);
    }

    /**
     * RELASI: Siswa → Skill (Many-to-Many)
     * =====================================
     * "Saya (siswa) menguasai BANYAK skill bahasa pemrograman"
     *
     * belongsToMany artinya relasi many-to-many yang memakai tabel PIVOT.
     * Parameter kedua 'siswa_skill' = nama tabel pivot.
     *
     * CARA PAKAI:
     *   $siswa->skills            // collection semua skill yang dikuasai siswa
     *   $siswa->skills()->sync([1,2,3]);  // set/atur skill yang dikuasai
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'siswa_skill');
    }
}
