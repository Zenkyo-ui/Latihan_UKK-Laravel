<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penilaian;
use App\Models\Siswa;

/**
 * SEEDER PENILAIAN
 * =================
 * Mengisi data dummy penilaian PKL untuk siswa-siswa yang sudah ada.
 *
 * Tiap siswa dibuatkan 1 penilaian (karena relasinya 1:1).
 * Data diambil dari NIS siswa yang dibuat di SiswaSeeder.
 */
class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil siswa berdasarkan NIS (yang dibuat di SiswaSeeder)
        $siswa1 = Siswa::where('nis', '22231001')->first(); // Ahmad Rizky
        $siswa2 = Siswa::where('nis', '22231002')->first(); // Siti Nurhaliza
        $siswa3 = Siswa::where('nis', '22231003')->first(); // Ahmad Fauzi Nugraha
        $siswa4 = Siswa::where('nis', '22231004')->first(); // Siti Nurhaliza Putri

        // Siswa BARU (data dummy)
        $siswa5 = Siswa::where('nis', '22231005')->first(); // Putra Pratama
        $siswa6 = Siswa::where('nis', '22231006')->first(); // Dewi Sartika
        $siswa7 = Siswa::where('nis', '22231007')->first(); // Rizki Ramadhan
        $siswa8 = Siswa::where('nis', '22231008')->first(); // Intan Permata
        $siswa9 = Siswa::where('nis', '22231009')->first(); // Bayu Aji
        $siswa10 = Siswa::where('nis', '22231010')->first(); // Salsa Nurfadilah

        $data = [
            [
                'tanggal_penilaian' => '2026-12-20',
                'siswa_id'          => $siswa1?->id ?? 1,
                'skor'              => 88,
                'status_penguasaan' => 'Sangat Mahir',
                'keaktifan'         => 'Sangat Baik',
                'sikap'             => 'Sangat Baik',
                'status_tamat'      => 'Lulus',
                'catatan'           => 'Siswa sangat aktif dan cepat memahami project yang diberikan.',
            ],
            [
                'tanggal_penilaian' => '2026-12-21',
                'siswa_id'          => $siswa2?->id ?? 2,
                'skor'              => 92,
                'status_penguasaan' => 'Sangat Mahir',
                'keaktifan'         => 'Sangat Baik',
                'sikap'             => 'Baik',
                'status_tamat'      => 'Lulus',
                'catatan'           => 'Menguasai materi dengan sangat baik, disiplin dan bertanggung jawab.',
            ],
            [
                'tanggal_penilaian' => '2026-12-22',
                'siswa_id'          => $siswa3?->id ?? 3,
                'skor'              => 65,
                'status_penguasaan' => 'Cukup',
                'keaktifan'         => 'Cukup',
                'sikap'             => 'Baik',
                'status_tamat'      => 'Tidak Lulus',
                'catatan'           => 'Kemampuan teknis masih perlu ditingkatkan, kehadiran kadang terlambat.',
            ],
            [
                'tanggal_penilaian' => '2026-12-23',
                'siswa_id'          => $siswa4?->id ?? 4,
                'skor'              => 78,
                'status_penguasaan' => 'Mahir',
                'keaktifan'         => 'Baik',
                'sikap'             => 'Sangat Baik',
                'status_tamat'      => 'Lulus',
                'catatan'           => 'Cukup mahir di bidang multimedia, perlu meningkatkan kepercayaan diri.',
            ],

            // ===== PENILAIAN SISWA BARU (data dummy) =====
            [
                'tanggal_penilaian' => '2026-12-24',
                'siswa_id'          => $siswa5?->id ?? 5,
                'skor'              => 84,
                'status_penguasaan' => 'Mahir',
                'keaktifan'         => 'Baik',
                'sikap'             => 'Baik',
                'status_tamat'      => 'Lulus',
                'catatan'           => 'Paham alur pengembangan aplikasi dengan baik, komunikasi cukup lancar.',
            ],
            [
                'tanggal_penilaian' => '2026-12-25',
                'siswa_id'          => $siswa6?->id ?? 6,
                'skor'              => 90,
                'status_penguasaan' => 'Sangat Mahir',
                'keaktifan'         => 'Sangat Baik',
                'sikap'             => 'Sangat Baik',
                'status_tamat'      => 'Lulus',
                'catatan'           => 'Prestasi sangat baik, mampu bekerja mandiri dan menyelesaikan project tepat waktu.',
            ],
            [
                'tanggal_penilaian' => '2026-12-26',
                'siswa_id'          => $siswa7?->id ?? 7,
                'skor'              => 58,
                'status_penguasaan' => 'Kurang',
                'keaktifan'         => 'Cukup',
                'sikap'             => 'Cukup',
                'status_tamat'      => 'Tidak Lulus',
                'catatan'           => 'Sering terlambat dan kemampuan teknis masih kurang, perlu pembinaan lanjutan.',
            ],
            [
                'tanggal_penilaian' => '2026-12-27',
                'siswa_id'          => $siswa8?->id ?? 8,
                'skor'              => 76,
                'status_penguasaan' => 'Mahir',
                'keaktifan'         => 'Baik',
                'sikap'             => 'Sangat Baik',
                'status_tamat'      => 'Lulus',
                'catatan'           => 'Kreatif dalam desain, rapi dan bertanggung jawab atas tugas yang diberikan.',
            ],
            [
                'tanggal_penilaian' => '2026-12-28',
                'siswa_id'          => $siswa9?->id ?? 9,
                'skor'              => 69,
                'status_penguasaan' => 'Cukup',
                'keaktifan'         => 'Cukup',
                'sikap'             => 'Baik',
                'status_tamat'      => 'Tidak Lulus',
                'catatan'           => 'Kemampuan dasar cukup tapi perlu lebih tekun dan memperbanyak latihan coding.',
            ],
            [
                'tanggal_penilaian' => '2026-12-29',
                'siswa_id'          => $siswa10?->id ?? 10,
                'skor'              => 82,
                'status_penguasaan' => 'Mahir',
                'keaktifan'         => 'Sangat Baik',
                'sikap'             => 'Baik',
                'status_tamat'      => 'Lulus',
                'catatan'           => 'Aktif membantu tim, mampu mengkonfigurasi jaringan dengan baik.',
            ],
        ];

        foreach ($data as $item) {
            // createOrCreate mencegah duplikat kalau seeder dijalankan berulang
            Penilaian::updateOrCreate(
                ['siswa_id' => $item['siswa_id']],
                $item
            );
        }
    }
}
