<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kompetensi;
use App\Models\Skill;

/**
 * SEEDER RELASI KOMPETENSI (JURUSAN) ↔ SKILL
 * ============================================
 * Mengisi tabel pivot 'kompetensi_skill' = "skill mana milik jurusan mana".
 *
 * Relasi many-to-many:
 * - 1 jurusan memakai BANYAK skill
 * - 1 skill bisa dipakai BANYAK jurusan (skill "bareng")
 *
 * CONTOH SKILL BARE:
 * - "Pemrograman OOP" → dipakai PPLG + Mobile Development
 * - "Pengembangan API" → dipakai PPLG + Mobile Development
 *
 * CARA KERJA SEEDER:
 * 1. Ambil nama jurusan → cari id di tabel kompetensis
 * 2. Ambil nama skill → cari id di tabel skills
 * 3. syncWithoutDetaching = hubungkan keduanya di pivot (tanpa menghapus relasi lama)
 *
 * CATATAN:
 * syncWithoutDetaching membuat seeder ini aman dijalankan berkali-kali.
 */
class KompetensiSkillSeeder extends Seeder
{
    public function run(): void
    {
        // Peta: NAMA JURUSAN => daftar NAMA SKILL milik jurusan tsb
        $map = [
            'PPLG' => [
                'Logika Algoritma',
                'HTML/CSS/JavaScript',
                'Pengembangan Web Frontend',
                'Pengembangan Web Backend',
                'Dasar Pembuatan Game (Unity)',
                'Dasar Pembuatan Game (Godot)',
                'Dasar Pembuatan Game (Construct)',
                'Pemrograman OOP',
                'Pengelolaan Database MySQL',
                'Pengelolaan Database PostgreSQL',
                'Kontrol Versi (Git)',
                'Kontrol Versi (GitHub)',
                'Framework Laravel',
                'Framework React',
                'Framework Vue.js',
                'Node.js',
                'Pengembangan API',
            ],
            'TKJ' => [
                'Perakitan & Troubleshooting PC/OS',
                'IP Addressing',
                'Jaringan MikroTik',
                'Jaringan Cisco',
                'Administrasi Server Linux',
                'Instalasi Fiber Optic',
            ],
            'MM' => [
                'Desain Grafis (Photoshop)',
                'Desain Grafis (Illustrator)',
                'Video Editing (Premiere Pro)',
                'Perancangan UI/UX (Figma)',
                'Motion Graphics',
            ],
            'Mobile Development' => [
                'Pemrograman OOP',
                'Layouting UI Mobile',
                'Pengembangan API',
                'Flutter',
                'React Native',
                'Kotlin',
                'Swift',
            ],
            'Game Development' => [
                'Logika & Fisika Game',
                'Scripting C#',
                'Scripting C++',
                'Penyusunan GDD',
                'Game Engine Unity',
                'Game Engine Unreal',
                'Pemodelan Aset 3D (Blender)',
            ],
            'Cloud Computing' => [
                'Navigasi Terminal Linux',
                'Virtualisasi',
                'Web Server (Nginx)',
                'Web Server (Apache)',
                'AWS',
                'GCP',
                'Azure',
                'Docker',
                'Alur Kerja DevOps',
            ],
            'Cyber Security' => [
                'Dasar Keamanan Jaringan',
                'OS Linux (Kali Linux)',
                'Ethical Hacking',
                'Penetration Testing (OWASP)',
                'Analisis SOC',
            ],
            'Data Science' => [
                'Statistik Dasar',
                'Python (Pandas)',
                'Python (NumPy)',
                'Querying SQL',
                'Visualisasi Data (Power BI)',
                'Visualisasi Data (Tableau)',
                'Machine Learning Dasar',
            ],
            'IT Support' => [
                'Pemeliharaan Hardware',
                'Pemeliharaan Software',
                'Instalasi OS & Driver',
                'Helpdesk',
                'Remote Support',
                'Pengelolaan Active Directory',
            ],
        ];

        foreach ($map as $namaKompetensi => $daftarSkill) {
            // Cari jurusan berdasarkan nama
            $kompetensi = Kompetensi::where('nama_kompetensi', $namaKompetensi)->first();
            if (!$kompetensi) {
                continue; // jurusan tidak ada → lewati
            }

            // Ambil id skill dari daftar nama skill
            $skillIds = Skill::whereIn('nama_skill', $daftarSkill)->pluck('id')->all();

            // syncWithoutDetaching = hubungkan tanpa menghapus relasi yg sudah ada
            $kompetensi->skills()->syncWithoutDetaching($skillIds);
        }
    }
}