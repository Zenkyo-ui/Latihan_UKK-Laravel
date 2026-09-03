<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

/**
 * SEEDER SKILL
 * =============
 * Mengisi data skill / kemampuan yang dikuasai siswa, berdasarkan
 * kisi-kisi KURIKULUM JURUSAN SMK.
 *
 * Setiap skill adalah 1 baris UNIK (updateOrCreate berdasarkan nama_skill).
 * Hubungan "skill milik jurusan mana" DIISI TERPISAH oleh
 * KompetensiSkillSeeder lewat tabel pivot kompetensi_skill.
 * (contoh: skill "Pemrograman OOP" dipakai PPLG + Mobile Dev)
 *
 * CATATAN:
 * Pakai updateOrCreate supaya seeder aman dijalankan berkali-kali
 * (tidak membuat data duplikat).
 */
class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // ---------- PPLG (Pengembangan Perangkat Lunak & Game) ----------
            ['nama_skill' => 'Logika Algoritma', 'deskripsi' => 'Dasar berpikir logis & penyusunan algoritma (flowchart, pseudocode)'],
            ['nama_skill' => 'HTML/CSS/JavaScript', 'deskripsi' => 'Trio dasar membangun tampilan & interaksi halaman web'],
            ['nama_skill' => 'Pengembangan Web Frontend', 'deskripsi' => 'Membangun sisi tampilan yang dilihat & dipakai user'],
            ['nama_skill' => 'Pengembangan Web Backend', 'deskripsi' => 'Membangun sisi server, logika, dan database aplikasi web'],
            ['nama_skill' => 'Dasar Pembuatan Game (Unity)', 'deskripsi' => 'Pengenalan game engine Unity untuk membuat game sederhana'],
            ['nama_skill' => 'Dasar Pembuatan Game (Godot)', 'deskripsi' => 'Game engine open-source Godot untuk 2D/3D'],
            ['nama_skill' => 'Dasar Pembuatan Game (Construct)', 'deskripsi' => 'Game engine berbasis event untuk pemula tanpa banyak kode'],

            // ---------- PPLG Web & Database (dari gabungan RPL) ----------
            ['nama_skill' => 'Pemrograman OOP', 'deskripsi' => 'Object Oriented Programming: class, object, inheritance, dll'],
            ['nama_skill' => 'Pengelolaan Database MySQL', 'deskripsi' => 'Design & query database relasional dengan MySQL'],
            ['nama_skill' => 'Pengelolaan Database PostgreSQL', 'deskripsi' => 'Manajemen database open-source PostgreSQL'],
            ['nama_skill' => 'Kontrol Versi (Git)', 'deskripsi' => 'Version control untuk melacak perubahan kode'],
            ['nama_skill' => 'Kontrol Versi (GitHub)', 'deskripsi' => 'Platform remote untuk kolaborasi & penyimpanan repo Git'],
            ['nama_skill' => 'Framework Laravel', 'deskripsi' => 'Framework PHP untuk pengembangan web modern & rapih'],
            ['nama_skill' => 'Framework React', 'deskripsi' => 'Library JavaScript untuk membangun UI interaktif'],
            ['nama_skill' => 'Framework Vue.js', 'deskripsi' => 'Framework JavaScript progresif untuk frontend'],
            ['nama_skill' => 'Node.js', 'deskripsi' => 'Runtime JavaScript untuk pengembangan backend'],
            ['nama_skill' => 'Pengembangan API', 'deskripsi' => 'Membangun & mengkonsumsi REST API untuk pertukaran data'],

            // ---------- TKJ (Teknik Komputer dan Jaringan) ----------
            ['nama_skill' => 'Perakitan & Troubleshooting PC/OS', 'deskripsi' => 'Merakit komputer & mengatasi masalah hardware/OS'],
            ['nama_skill' => 'IP Addressing', 'deskripsi' => 'Pemberian & perhitungan alamat IP (IPv4/IPv6, subnetting)'],
            ['nama_skill' => 'Jaringan MikroTik', 'deskripsi' => 'Konfigurasi router & bandwidth dengan MikroTik'],
            ['nama_skill' => 'Jaringan Cisco', 'deskripsi' => 'Konfigurasi switch/router Cisco untuk jaringan skala besar'],
            ['nama_skill' => 'Administrasi Server Linux', 'deskripsi' => 'Mengelola user, file, service di server Linux'],
            ['nama_skill' => 'Instalasi Fiber Optic', 'deskripsi' => 'Pemasangan & perbaikan kabel fiber optik'],

            // ---------- MM (Multimedia) ----------
            ['nama_skill' => 'Desain Grafis (Photoshop)', 'deskripsi' => 'Mendesain & edit gambar dengan Adobe Photoshop'],
            ['nama_skill' => 'Desain Grafis (Illustrator)', 'deskripsi' => 'Membuat ilustrasi & desain vektor dengan Illustrator'],
            ['nama_skill' => 'Video Editing (Premiere Pro)', 'deskripsi' => 'Mengedit video dengan Adobe Premiere Pro'],
            ['nama_skill' => 'Perancangan UI/UX (Figma)', 'deskripsi' => 'Merancang tampilan aplikasi & pengalaman pengguna di Figma'],
            ['nama_skill' => 'Motion Graphics', 'deskripsi' => 'Membuat animasi & grafis bergerak'],

            // ---------- Mobile Development ----------
            ['nama_skill' => 'Layouting UI Mobile', 'deskripsi' => 'Menyusun tampilan aplikasi mobile yang mudah dipakai'],
            ['nama_skill' => 'Flutter', 'deskripsi' => 'Framework cross-platform untuk aplikasi Android/iOS'],
            ['nama_skill' => 'React Native', 'deskripsi' => 'Framework mobile berbasis JavaScript/React'],
            ['nama_skill' => 'Kotlin', 'deskripsi' => 'Bahasa pemrograman native untuk Android modern'],
            ['nama_skill' => 'Swift', 'deskripsi' => 'Bahasa pemrograman native untuk iOS'],

            // ---------- Game Development ----------
            ['nama_skill' => 'Logika & Fisika Game', 'deskripsi' => 'Logika gameplay & simulasi fisika dalam game'],
            ['nama_skill' => 'Scripting C#', 'deskripsi' => 'Menulis skrip gameplay dengan C# (Unity)'],
            ['nama_skill' => 'Scripting C++', 'deskripsi' => 'Menulis kode performa tinggi dengan C++ (Unreal)'],
            ['nama_skill' => 'Penyusunan GDD', 'deskripsi' => 'Game Design Document: rancangan konsep game'],
            ['nama_skill' => 'Game Engine Unity', 'deskripsi' => 'Mengembangkan game 2D/3D dengan Unity'],
            ['nama_skill' => 'Game Engine Unreal', 'deskripsi' => 'Mengembangkan game visual tinggi dengan Unreal Engine'],
            ['nama_skill' => 'Pemodelan Aset 3D (Blender)', 'deskripsi' => 'Membuat model 3D & aset game dengan Blender'],

            // ---------- Cloud Computing ----------
            ['nama_skill' => 'Navigasi Terminal Linux', 'deskripsi' => 'Perintah dasar terminal & scripting shell di Linux'],
            ['nama_skill' => 'Virtualisasi', 'deskripsi' => 'Membuat & mengelola mesin virtual (VM/container)'],
            ['nama_skill' => 'Web Server (Nginx)', 'deskripsi' => 'Konfigurasi & optimasi web server Nginx'],
            ['nama_skill' => 'Web Server (Apache)', 'deskripsi' => 'Konfigurasi & manajemen web server Apache'],
            ['nama_skill' => 'AWS', 'deskripsi' => 'Layanan cloud Amazon Web Services'],
            ['nama_skill' => 'GCP', 'deskripsi' => 'Layanan cloud Google Cloud Platform'],
            ['nama_skill' => 'Azure', 'deskripsi' => 'Layanan cloud Microsoft Azure'],
            ['nama_skill' => 'Docker', 'deskripsi' => 'Pengemasan & deploy aplikasi dengan container Docker'],
            ['nama_skill' => 'Alur Kerja DevOps', 'deskripsi' => 'Kolaborasi development & operations (CI/CD)'],

            // ---------- Cyber Security ----------
            ['nama_skill' => 'Dasar Keamanan Jaringan', 'deskripsi' => 'Pemahaman firewall, port, dan ancaman jaringan'],
            ['nama_skill' => 'OS Linux (Kali Linux)', 'deskripsi' => 'Distro Linux khusus untuk uji keamanan'],
            ['nama_skill' => 'Ethical Hacking', 'deskripsi' => 'Teknik hacking legal untuk menguji & melindungi sistem'],
            ['nama_skill' => 'Penetration Testing (OWASP)', 'deskripsi' => 'Uji penetrasi aplikasi sesuai standar OWASP'],
            ['nama_skill' => 'Analisis SOC', 'deskripsi' => 'Monitoring & analisis Security Operations Center'],

            // ---------- Data Science ----------
            ['nama_skill' => 'Statistik Dasar', 'deskripsi' => 'Dasar-dasar statistik untuk analisis data'],
            ['nama_skill' => 'Python (Pandas)', 'deskripsi' => 'Manipulasi & analisis data dengan library Pandas'],
            ['nama_skill' => 'Python (NumPy)', 'deskripsi' => 'Komputasi numerik & array dengan library NumPy'],
            ['nama_skill' => 'Querying SQL', 'deskripsi' => 'Mengambil & mengolah data menggunakan SQL'],
            ['nama_skill' => 'Visualisasi Data (Power BI)', 'deskripsi' => 'Membuat dashboard data interaktif dengan Power BI'],
            ['nama_skill' => 'Visualisasi Data (Tableau)', 'deskripsi' => 'Membuat visualisasi data dengan Tableau'],
            ['nama_skill' => 'Machine Learning Dasar', 'deskripsi' => 'Konsep dasar pembelajaran mesin (regresi, klasifikasi)'],

            // ---------- IT Support ----------
            ['nama_skill' => 'Pemeliharaan Hardware', 'deskripsi' => 'Perawatan & perbaikan perangkat keras komputer'],
            ['nama_skill' => 'Pemeliharaan Software', 'deskripsi' => 'Instalasi, update, & perbaikan perangkat lunak'],
            ['nama_skill' => 'Instalasi OS & Driver', 'deskripsi' => 'Menginstal sistem operasi & driver perangkat'],
            ['nama_skill' => 'Helpdesk', 'deskripsi' => 'Memberikan dukungan teknis ke pengguna'],
            ['nama_skill' => 'Remote Support', 'deskripsi' => 'Bantuan jarak jauh untuk masalah komputer'],
            ['nama_skill' => 'Pengelolaan Active Directory', 'deskripsi' => 'Manajemen user & komputer di domain Windows'],
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