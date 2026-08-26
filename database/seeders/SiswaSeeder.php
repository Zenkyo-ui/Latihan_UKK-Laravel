<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Perusahaan;
use App\Models\Kompetensi;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perusahaan1 = Perusahaan::where('nama_perusahaan', 'PT Sinergi Digital Nusantara')->first();
        $perusahaan2 = Perusahaan::where('nama_perusahaan', 'CV Karya Teknologi')->first();

        $pplg = Kompetensi::where('nama_kompetensi', 'PPLG')->first();
        $tkj = Kompetensi::where('nama_kompetensi', 'TKJ')->first();
        $mm = Kompetensi::where('nama_kompetensi', 'MM')->first();
        $rpl = Kompetensi::where('nama_kompetensi', 'RPL')->first();

        $data = [
            [
                'nis' => '22231001',
                'nama' => 'Ahmad Rizky',
                'kelas' => 'XII PPLG 1',
                'perusahaan_id' => $perusahaan1?->id ?? 1,
                'kompetensi_id' => $pplg?->id ?? 1,
                'tanggal_mulai_pkl' => '2026-07-01',
                'tanggal_selesai_pkl' => '2026-12-31',
            ],
            [
                'nis' => '22231002',
                'nama' => 'Siti Nurhaliza',
                'kelas' => 'XII PPLG 2',
                'perusahaan_id' => $perusahaan2?->id ?? 2,
                'kompetensi_id' => $pplg?->id ?? 1,
                'tanggal_mulai_pkl' => '2026-07-01',
                'tanggal_selesai_pkl' => '2026-12-31',
            ],
            [
                'nis' => '22231003',
                'nama' => 'Ahmad Fauzi Nugraha',
                'kelas' => 'XII TKJ 1',
                'perusahaan_id' => $perusahaan1?->id ?? 1,
                'kompetensi_id' => $tkj?->id ?? 3,
                'tanggal_mulai_pkl' => '2026-08-01',
                'tanggal_selesai_pkl' => '2027-01-31',
            ],
            [
                'nis' => '22231004',
                'nama' => 'Siti Nurhaliza Putri',
                'kelas' => 'XII MM 1',
                'perusahaan_id' => $perusahaan2?->id ?? 2,
                'kompetensi_id' => $mm?->id ?? 4,
                'tanggal_mulai_pkl' => '2026-08-01',
                'tanggal_selesai_pkl' => '2027-01-31',
            ],
        ];

        foreach ($data as $item) {
            Siswa::create($item);
        }
    }
}
