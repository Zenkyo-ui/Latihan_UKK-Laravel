<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kompetensi;

/**
 * SEEDER KOMPETENSI
 * ==================
 * Mengisi data kompetensi / bidang keahlian (PPLG, TKJ, MM, dll).
 *
 * CATATAN:
 * Pakai updateOrCreate berdasarkan 'nama_kompetensi' supaya seeder aman
 * dijalankan berkali-kali (tidak membuat data duplikat).
 */
class KompetensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_kompetensi' => 'PPLG', 'deskripsi' => 'Pengembangan Perangkat Lunak dan Game'],
            ['nama_kompetensi' => 'RPL', 'deskripsi' => 'Rekayasa Perangkat Lunak'],
            ['nama_kompetensi' => 'TKJ', 'deskripsi' => 'Teknik Komputer dan Jaringan'],
            ['nama_kompetensi' => 'MM', 'deskripsi' => 'Multimedia'],
            ['nama_kompetensi' => 'Mobile Development', 'deskripsi' => 'Pengembangan Aplikasi Mobile'],
            ['nama_kompetensi' => 'Game Development', 'deskripsi' => 'Pengembangan Game'],
            ['nama_kompetensi' => 'Cloud Computing', 'deskripsi' => 'Komputasi Awan'],
            ['nama_kompetensi' => 'Cyber Security', 'deskripsi' => 'Keamanan Siber'],
            ['nama_kompetensi' => 'Data Science', 'deskripsi' => 'Ilmu Data dan Analitik'],
            ['nama_kompetensi' => 'IT Support', 'deskripsi' => 'Dukungan Teknologi Informasi'],
        ];

        // updateOrCreate = kalau nama kompetensi sudah ada, UPDATE; kalau belum, CREATE.
        foreach ($data as $item) {
            Kompetensi::updateOrCreate(
                ['nama_kompetensi' => $item['nama_kompetensi']], // cek berdasarkan nama
                $item                                           // data yang diisi/diperbarui
            );
        }
    }
}
