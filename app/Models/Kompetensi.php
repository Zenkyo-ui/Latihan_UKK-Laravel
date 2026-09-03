<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * MODEL KOMPETENSI
 * =================
 * Model ini merepresentasikan tabel 'kompetensis' di database.
 * Setiap baris = 1 bidang keahlian (PPLG, TKJ, MM, dll).
 *
 * RELASI:
 * - Kompetensi hasMany Siswa (satu kompetensi dimiliki banyak siswa)
 *
 * CONTOH PENGGUNAAN:
 *   $k = Kompetensi::find(1);
 *   $k->siswa;           // collection semua siswa yang ambil PPLG
 *   $k->siswa_count;     // jumlah siswa (kalau pakai withCount)
 */
class Kompetensi extends Model
{
    use HasFactory;

    /**
     * $fillable = kolom yang BOLEH diisi massal via Kompetensi::create([...])
     */
    protected $fillable = [
        'nama_kompetensi',  // Nama kompetensi (contoh: "PPLG")
        'deskripsi',        // Deskripsi singkat
    ];

    /**
     * RELASI: Kompetensi → Siswa (1:N)
     * =================================
     * "Saya (kompetensi/jurusan) dimiliki BANYAK siswa yang mengambil jurusan ini"
     *
     * hasMany artinya FK (kompetensi_id) ada di TABEL LAIN (siswas).
     *
     * CARA PAKAI:
     *   $kompetensi->siswa             // collection semua siswa di jurusan ini
     *   $kompetensi->siswa_count       // jumlah (kalau pakai withCount)
     */
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kompetensi_id');
    }

    /**
     * RELASI: Kompetensi → Skill (Many-to-Many)
     * ==========================================
     * "Saya (jurusan) memakai BANYAK skill"
     *
     * relates ke tabel pivot 'kompetensi_skill'.
     * Satu jurusan bisa memakai beberapa skill, contoh:
     * PPLG → Logika OOP, MySQL, Git, Laravel, dll.
     *
     * CARA PAKAI:
     *   $kompetensi->skills        // collection semua skill yang dipakai jurusan ini
     *   $kompetensi->skills->pluck('nama_skill')  // daftar nama skill
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'kompetensi_skill');
    }
}