<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * MODEL SKILL
 * ============
 * Model ini merepresentasikan tabel 'skills' di database.
 * Setiap baris = 1 skill / kemampuan bahasa pemrograman
 * (HTML, CSS, JavaScript, PHP, MySQL, dll).
 *
 * KONSEP:
 * Skill ini BEDA dengan kompetensi (jurusan).
 * - Kompetensi/jurusan = bidang keahlian siswa (PPLG, TKJ, MM) — 1 siswa 1 jurusan.
 * - Skill = kemampuan spesifik yang dikuasai siswa — 1 siswa bisa BANYAK skill.
 *
 * RELASI:
 * - Skill belongsToMany Siswa (satu skill dikuasai banyak siswa)
 *   via tabel pivot 'siswa_skill'.
 *
 * CONTOH PENGGUNAAN:
 *   $skill = Skill::withCount('siswa')->find(1);
 *   $skill->nama_skill;      // "HTML"
 *   $skill->siswa_count;     // berapa siswa yang menguasai skill ini
 *   $skill->siswa;           // collection semua siswa yang menguasai skill ini
 */
class Skill extends Model
{
    use HasFactory;

    /**
     * $fillable = kolom yang BOLEH diisi massal via Skill::create([...])
     */
    protected $fillable = [
        'nama_skill',   // Nama skill (contoh: "HTML")
        'deskripsi',    // Keterangan singkat
    ];

    /**
     * RELASI: Skill → Siswa (Many-to-Many)
     * =====================================
     * "Saya (skill) dikuasai BANYAK siswa"
     *
     * belongsToMany artinya relasi many-to-many yang memakai tabel PIVOT.
     * Parameter kedua 'siswa_skill' = nama tabel pivot.
     *
     * CARA PAKAI:
     *   $skill->siswa          // collection semua siswa yang menguasai skill ini
     *   $skill->siswa_count    // jumlah siswa (kalau pakai withCount)
     */
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'siswa_skill');
    }

    /**
     * RELASI: Skill → Kompetensi (Many-to-Many)
     * ==========================================
     * "Saya (skill) dipakai BANYAK jurusan"
     *
     * relates ke tabel pivot 'kompetensi_skill'.
     * Satu skill bisa terhubung ke beberapa jurusan, contoh:
     * "Logika OOP" → RPL + Mobile Development.
     *
     * CARA PAKAI:
     *   $skill->kompetensi            // collection semua jurusan yang pakai skill ini
     *   $skill->kompetensi()->sync([1,2]);  // set jurusan mana yang memakai skill ini
     */
    public function kompetensi()
    {
        return $this->belongsToMany(Kompetensi::class, 'kompetensi_skill');
    }
}
