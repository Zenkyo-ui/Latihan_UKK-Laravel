<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Skill;

/**
 * SEEDER RELASI SISWA ↔ SKILL
 * ============================
 * Mengisi tabel pivot 'siswa_skill' = "skill yang dikuasai oleh tiap siswa".
 *
 * Data ini mencerminkan skill KEJURUAN yang relevan dengan jurusan tiap siswa:
 * - Siswa TKJ  → skill jaringan & perangkat keras
 * - Siswa PPLG → skill pemrograman web
 * - Siswa MM   → skill desain grafis & video editing
 *
 * CARA KERJA:
 * 1. Cari siswa berdasarkan NIS.
 * 2. Cari skill berdasarkan nama.
 * 3. sync = timpa relasi siswa↔skill agar pas dengan daftar berikut
 *    (mencegah duplikat & aman dijalankan berkali-kali).
 */
class SiswaSkillSeeder extends Seeder
{
    public function run(): void
    {
        // Peta: NIS SISWA => daftar NAMA SKILL yang dia kuasai
        $map = [
            '22231003' => [ // Ahmad Fauzi Nugraha (TKJ)
                'Perakitan & Troubleshooting PC/OS',
                'IP Addressing',
                'Jaringan MikroTik',
                'Instalasi Fiber Optic',
            ],
            '22231021' => [ // Aditya Pratama (PPLG)
                'Logika Algoritma',
                'HTML/CSS/JavaScript',
                'Pengembangan Web Frontend',
            ],
            '22231022' => [ // Salsabila Rahma (PPLG)
                'Pemrograman OOP',
                'Pengelolaan Database MySQL',
                'Pengelolaan Database PostgreSQL',
            ],
            '22231023' => [ // Rizky Firmansyah (TKJ)
                'Perakitan & Troubleshooting PC/OS',
                'IP Addressing',
                'Jaringan MikroTik',
            ],
            '22231024' => [ // Nabila Zain (PPLG)
                'Logika Algoritma',
                'HTML/CSS/JavaScript',
                'Pengembangan Web Frontend',
            ],
            '22231025' => [ // Dimas Anggara (MM)
                'Desain Grafis (Photoshop)',
                'Desain Grafis (Illustrator)',
                'Video Editing (Premiere Pro)',
            ],
            '22231026' => [ // Putri Handayani (PPLG)
                'Pemrograman OOP',
                'Pengelolaan Database MySQL',
                'Pengelolaan Database PostgreSQL',
            ],
            '22231027' => [ // Fajar Ramadhan (TKJ)
                'Perakitan & Troubleshooting PC/OS',
                'IP Addressing',
                'Jaringan MikroTik',
            ],
            '22231028' => [ // Aulia Rahman (PPLG)
                'Logika Algoritma',
                'HTML/CSS/JavaScript',
                'Pengembangan Web Frontend',
            ],
            '22231029' => [ // Dian Permata (MM)
                'Desain Grafis (Photoshop)',
                'Desain Grafis (Illustrator)',
                'Video Editing (Premiere Pro)',
            ],
            '22231030' => [ // Yoga Saputra (PPLG)
                'Pemrograman OOP',
                'Pengelolaan Database MySQL',
                'Pengelolaan Database PostgreSQL',
            ],
            '22231031' => [ // Citra Amelia (TKJ)
                'Perakitan & Troubleshooting PC/OS',
                'IP Addressing',
                'Jaringan MikroTik',
            ],
            '22231032' => [ // Farhan Maulana (PPLG)
                'Logika Algoritma',
                'HTML/CSS/JavaScript',
                'Pengembangan Web Frontend',
            ],
        ];

        foreach ($map as $nis => $daftarSkill) {
            $siswa = Siswa::where('nis', $nis)->first();
            if (!$siswa) {
                continue; // siswa tidak ada → lewati
            }

            $skillIds = Skill::whereIn('nama_skill', $daftarSkill)->pluck('id')->all();

            // sync = timpa relasi, aman dijalankan berkali-kali
            $siswa->skills()->sync($skillIds);
        }
    }
}