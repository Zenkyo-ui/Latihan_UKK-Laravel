<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

/**
 * SEEDER SKILL
 * =============
 * Mengisi data skill / kemampuan bahasa pemrograman yang dapat
 * dikuasai siswa (HTML, CSS, JavaScript, PHP, dll).
 *
 * Data skil dibuat MENYESUAIKAN jurusan yang ada di aplikasi:
 * - PPLG / RPL  → fokus pengembangan web & aplikasi (HTML, CSS, JS, PHP, DLL)
 * - TKJ         → jaringan & server (Linux, Jaringan Dasar)
 * - MM          → desain & multimedia (Photoshop, Figma)
 *
 * CATATAN:
 * Pakai updateOrCreate berdasarkan 'nama_skill' supaya seeder aman
 * dijalankan berkali-kali (tidak membuat data duplikat).
 */
class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_skill' => 'HTML', 'deskripsi' => 'Bahasa markup untuk menyusun struktur halaman web'],
            ['nama_skill' => 'CSS', 'deskripsi' => 'Bahasa untuk mempercantik tampilan halaman web'],
            ['nama_skill' => 'JavaScript', 'deskripsi' => 'Bahasa pemrograman untuk interaktivitas website'],
            ['nama_skill' => 'PHP', 'deskripsi' => 'Bahasa pemrograman server-side untuk backend web'],
            ['nama_skill' => 'MySQL', 'deskripsi' => 'Sistem manajemen database relasional'],
            ['nama_skill' => 'Laravel', 'deskripsi' => 'Framework PHP untuk pengembangan web modern'],
            ['nama_skill' => 'Python', 'deskripsi' => 'Bahasa pemrograman serbaguna untuk data & scripting'],
            ['nama_skill' => 'React', 'deskripsi' => 'Library JavaScript untuk membangun UI interaktif'],
            ['nama_skill' => 'Java', 'deskripsi' => 'Bahasa pemrograman berorientasi objek'],
            ['nama_skill' => 'C#', 'deskripsi' => 'Bahasa pemrograman untuk aplikasi .NET & game'],
        ];

        // updateOrCreate = kalau nama_skill sudah ada, UPDATE; kalau belum, CREATE.
        foreach ($data as $item) {
            Skill::updateOrCreate(
                ['nama_skill' => $item['nama_skill']], // cek berdasarkan nama
                $item                                 // data yang diisi/diperbarui
            );
        }
    }
}
