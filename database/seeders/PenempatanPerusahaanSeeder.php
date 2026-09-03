<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Perusahaan;

/**
 * SEEDER PENEMPATAN SISWA SESUAI JURUSAN
 * ========================================
 * Menempatkan setiap siswa ke perusahaan yang RELEVAN dengan jurusannya.
 *
 * CONTOH PEMETAAN:
 *   PPLG          → PT Sinergi Digital Nusantara (Software House)
 *   TKJ           → CV Karya Teknologi + PT Telekomunikasi (Jaringan)
 *   MM            → CV Digital Media Kreatif (Multimedia & Desain)
 *   Mobile Dev    → PT Nusantara Software (Software House)
 *   Game Dev      → PT Game Studio Indonesia
 *   Cloud         → PT Cloudindo Solusi Cloud
 *   Cyber Security→ PT Cyber Security Solutions
 *   Data Science  → PT Data Analytics Indonesia
 *   IT Support    → PT Solusi Teknologi IT
 *
 * CATATAN:
 * - Setelah semua siswa ditempatkan, kuota tiap perusahaan DISET = jumlah
 *   siswa yang masuk, sehingga selalu "Penuh" dan konsisten meski jumlah
 *   siswa dummy berubah. Ini berjalan TERAKHIR (setelah seluruh siswa dibuat).
 * - Perusahaan dicari berdasarkan NAMA supaya tetap aman walau ID berubah.
 */
class PenempatanPerusahaanSeeder extends Seeder
{
    public function run(): void
    {
        // Peta JURUSAN => NAMA PERUSAHAAN rumah
        $mapSatuPerusahaan = [
            'PPLG' => 'PT Sinergi Digital Nusantara',
            'MM' => 'CV Digital Media Kreatif',
            'Mobile Development' => 'PT Nusantara Software',
            'Game Development' => 'PT Game Studio Indonesia',
            'Cloud Computing' => 'PT Cloudindo Solusi Cloud',
            'Cyber Security' => 'PT Cyber Security Solutions',
            'Data Science' => 'PT Data Analytics Indonesia',
            'IT Support' => 'PT Solusi Teknologi IT',
        ];
        $rumahTKJ = ['CV Karya Teknologi', 'PT Telekomunikasi Jaringan Nusantara'];

        // Reset kuota semua perusahaan jadi 0 lalu alokasikan ulang.
        foreach (Perusahaan::all() as $p) {
            $p->update(['kuota' => 0]);
        }

        // 1) Jurusan dengan 1 perusahaan rumah
        $perusahaanByNama = [];
        foreach (Perusahaan::all() as $p) {
            $perusahaanByNama[$p->nama_perusahaan] = $p;
        }

        $penempatanPerusahaan = []; // perusahaan_id => jumlah

        foreach ($mapSatuPerusahaan as $jurusan => $namaPerusahaan) {
            $perusahaan = $perusahaanByNama[$namaPerusahaan] ?? null;
            if (!$perusahaan) {
                continue;
            }
            $siswaIds = Siswa::whereHas('kompetensi', fn ($q) => $q->where('nama_kompetensi', $jurusan))->pluck('id');
            foreach ($siswaIds as $id) {
                Siswa::where('id', $id)->update(['perusahaan_id' => $perusahaan->id]);
            }
            $penempatanPerusahaan[$perusahaan->id] = ($penempatanPerusahaan[$perusahaan->id] ?? 0) + $siswaIds->count();
        }

        // 2) TKJ dibagi rata ke dua perusahaan jaringan
        $tkjIds = Siswa::whereHas('kompetensi', fn ($q) => $q->where('nama_kompetensi', 'TKJ'))->pluck('id')->all();
        $half = intdiv(count($tkjIds), 2);
        $chunk1 = array_slice($tkjIds, 0, $half);
        $chunk2 = array_slice($tkjIds, $half);
        foreach ($rumahTKJ as $i => $namaPerusahaan) {
            $perusahaan = $perusahaanByNama[$namaPerusahaan] ?? null;
            if (!$perusahaan) {
                continue;
            }
            $batch = $i === 0 ? $chunk1 : $chunk2;
            foreach ($batch as $id) {
                Siswa::where('id', $id)->update(['perusahaan_id' => $perusahaan->id]);
            }
            $penempatanPerusahaan[$perusahaan->id] = ($penempatanPerusahaan[$perusahaan->id] ?? 0) + count($batch);
        }

        // 3) Set kuota = jumlah yang masuk → selalu penuh
        foreach ($penempatanPerusahaan as $perId => $jumlah) {
            Perusahaan::where('id', $perId)->update(['kuota' => max(1, $jumlah)]);
        }

        $this->command?->warn("PenempatanPerusahaanSeeder: " . array_sum($penempatanPerusahaan) . " siswa ditempatkan sesuai jurusan.");
    }
}