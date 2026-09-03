<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Perusahaan;
use App\Models\Kompetensi;
use App\Models\Skill;

/**
 * SEEDER SISWA DUMMY (MASSAL)
 * ============================
 * Mengisi sisa kuota PKL tiap perusahaan dengan siswa dummy baru.
 *
 * FITUR:
 * - Jurusan (kompetensi_id) diacak merata antar 9 jurusan.
 * - Skill siswa memakai skill sesuai jurusannya.
 * - Ada 2 tipe siswa (soal tingkat kompetensi):
 *     • KOMPETEN    → menguasai SEMUA skill jurusan.
 *     • INKOMPETEN  → hanya menguasai 1 skill dasar saja.
 *   Ini mewakili kondisi "ada siswa yang udah advance ada yang masih basic".
 *
 * CATATAN:
 * - Pakai NIS unik di range terpisah (22231101 dst) supaya TIDAK bentrok
 *   dengan siswa lama (22231001..22231032) dan aman dijalankan berkali-kali
 *   (updateOrCreate berbasis NIS).
 * - Tidak menyentuh siswa yang sudah ada sebelumnya.
 */
class SiswaDummySeeder extends Seeder
{
    /**
     * Peta nama jurusan → daftar skill (nama) sesuai KompetensiSkillSeeder.
     * Urutan menandakan tingkat: skill dasar di awal, skill advance di akhir.
     */
    private array $skillMap = [
        'PPLG' => [
            'Logika Algoritma',
            'HTML/CSS/JavaScript',
            'Pengembangan Web Frontend',
            'Pengembangan Web Backend',
            'Pemrograman OOP',
            'Framework Laravel',
            'Framework React',
            'Framework Vue.js',
            'Node.js',
            'Pengelolaan Database MySQL',
            'Pengelolaan Database PostgreSQL',
            'Kontrol Versi (Git)',
            'Kontrol Versi (GitHub)',
            'Pengembangan API',
            'Dasar Pembuatan Game (Unity)',
            'Dasar Pembuatan Game (Godot)',
            'Dasar Pembuatan Game (Construct)',
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
            'Layouting UI Mobile',
            'Flutter',
            'React Native',
            'Kotlin',
            'Swift',
            'Pemrograman OOP',
            'Pengembangan API',
        ],
        'Game Development' => [
            'Logika & Fisika Game',
            'Game Engine Unity',
            'Game Engine Unreal',
            'Scripting C#',
            'Scripting C++',
            'Penyusunan GDD',
            'Pemodelan Aset 3D (Blender)',
        ],
        'Cloud Computing' => [
            'Navigasi Terminal Linux',
            'Virtualisasi',
            'Docker',
            'Alur Kerja DevOps',
            'Web Server (Nginx)',
            'Web Server (Apache)',
            'AWS',
            'GCP',
            'Azure',
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

    /** Nama depan (banyak kombinasi → nama dummy deterministik). */
    private array $namaDepan = [
        'Ahmad', 'Muhammad', 'Rizky', 'Fajar', 'Dimas', 'Eko', 'Rendi', 'Andi', 'Budi', 'Raka',
        'Siti', 'Nur', 'Dewi', 'Intan', 'Putri', 'Salsa', 'Rina', 'Citra', 'Dian', 'Lita',
        'Bagus', 'Adit', 'Rangga', 'Yoga', 'Ilham', 'Fikri', 'Galih', 'Hafiz', 'Bayu', 'Rizki',
        'Amalia', 'Rahma', 'Laila', 'Fitri', 'Ayu', 'Mega', 'Dinda', 'Nabila', 'Zahra', 'Sari',
    ];

    /** Nama belakang normal (sebagian besar siswa). */
    private array $namaBelakang = [
        'Pratama', 'Saputra', 'Ramadhan', 'Firmansyah', 'Maulana', 'Hidayat', 'Nugraha', 'Kurniawan',
        'Wijaya', 'Santoso', 'Handayani', 'Lestari', 'Safitri', 'Rahayu', 'Wulandari', 'Anggraini',
        'Prabowo', 'Hermawan', 'Susanto', 'Yudha', 'Febriyani', 'Melati', 'Kusuma', 'Setiawan',
        'Permata', 'Maharani', 'Ardiansyah', 'Saputri', 'Gunawan', 'Hartono',
    ];

    /** Nama belakang absurd/meme — disisipkan selang-seling biar "seplenger". */
    private array $namaBelakangAbsurd = [
        'Gigi Kecil', 'Kepala Batu', 'Tangan Panjang', 'Mata Satu', 'Kaki Gatal', 'Pintu Rumah',
        'Si Cepat', 'Ngoding Malem', 'Kopi Susu', 'Jadi Gede', 'Tukang Rebahan', 'Nanya-Nanya',
        'Mimpi Tinggi', 'Keren Banget', 'Setop Dulu', 'Gass Terus', 'Berkah Selalu', 'Hoki Terus',
        'Ngantuk Bangeet', 'Healing Dulu', 'Asik Banget', 'Sok Cool', 'Ngegame Muluu',
    ];

    public function run(): void
    {
        // Jumlah tambahan siswa per perusahaan (sisa kuota).
        // Diisi sampai kuota penuh; perusahaan 2 (CV Karya Teknologi) sudah penuh → dilewati.
        $targetKuotaPerusahaan = [
            1 => 40,  // PT Sinergi Digital Nusantara
            3 => 30,  // PT Nusantara Software
            4 => 25,  // PT Telekomunikasi Jaringan Nusantara
            5 => 15,  // CV Digital Media Kreatif
        ];

        // NIS awal untuk siswa dummy (range terpisah dari siswa lama).
        $nisStart = 22231101;
        $nilaiNis = $nisStart;

        // Bangun mapping nama jurusan → objek Kompetensi.
        $kompetensiByNama = [];
        foreach (Kompetensi::all() as $k) {
            $kompetensiByNama[$k->nama_kompetensi] = $k;
        }
        $jurusanList = array_keys($this->skillMap); // urutan jurusan

        // Putar jurusan merata: 0,1,2,...,8,0,1,2,... supaya sebaran rata.
        $kelasJurusan = [
            'PPLG' => 1, 'TKJ' => 1, 'MM' => 1, 'Mobile Development' => 1,
            'Game Development' => 1, 'Cloud Computing' => 1, 'Cyber Security' => 1,
            'Data Science' => 1, 'IT Support' => 1,
        ];

        $namaIdx = 0;
        $jurusanIdx = 0;
        $totalDitambah = 0;

        foreach ($targetKuotaPerusahaan as $perusahaanId => $kuota) {
            $perusahaan = Perusahaan::find($perusahaanId);
            if (!$perusahaan) {
                continue;
            }

            // Berapa siswa yang sudah ada di perusahaan ini.
            $sudah = $perusahaan->siswa()->count();
            $jumlahBaru = max(0, $kuota - $sudah);

            for ($i = 0; $i < $jumlahBaru; $i++) {
                // Pilih jurusan secara bergilir supaya merata.
                $namaJurusan = $jurusanList[$jurusanIdx % count($jurusanList)];
                $jurusanIdx++;
                $kompetensi = $kompetensiByNama[$namaJurusan];

                // Tentukan kelas berdasarkan jurusan, buat bervariasi (1-3).
                $nomorKelas = (($nilaiNis + $i) % 3) + 1;
                $kelas = 'XII ' . $namaJurusan . ' ' . $nomorKelas;

                // Tipe siswa: KOMPETEN (50%) atau INKOMPETEN (50%).
                $kompeten = ((bool) random_int(0, 1));

                $nis = (string) $nilaiNis;
                $namaDepan = $this->namaDepan[$namaIdx % count($this->namaDepan)];
                // Selang-seling: 1 dari 3 siswa diberi nama belakang meme → "seplenger".
                if ($namaIdx % 3 === 1) {
                    $namaBelakang = $this->namaBelakangAbsurd[$namaIdx % count($this->namaBelakangAbsurd)];
                } else {
                    $namaBelakang = $this->namaBelakang[($namaIdx + 7) % count($this->namaBelakang)];
                }
                $namaIdx++;

                $data = [
                    'nis' => $nis,
                    'nama' => $namaDepan . ' ' . $namaBelakang,
                    'kelas' => $kelas,
                    'perusahaan_id' => $perusahaanId,
                    'kompetensi_id' => $kompetensi->id,
                    'tanggal_mulai_pkl' => '2026-09-01',
                    'tanggal_selesai_pkl' => '2026-12-20',
                ];

                $siswa = Siswa::updateOrCreate(['nis' => $nis], $data);

                // Atur skill sesuai jurusan & tingkat kompetensi.
                $daftarSkillNama = $this->skillMap[$namaJurusan];
                if ($kompeten) {
                    $skillDipilih = $daftarSkillNama; // semua skill jurusan
                } else {
                    $skillDipilih = [reset($daftarSkillNama)]; // hanya 1 skill dasar
                }

                $skillIds = Skill::whereIn('nama_skill', $skillDipilih)->pluck('id')->all();
                $siswa->skills()->sync($skillIds);

                // Lanjutkan NIS untuk siswa berikutnya.
                $nilaiNis++;
                $totalDitambah++;
            }
        }

        $this->command?->warn("SiswaDummySeeder: menambahkan {$totalDitambah} siswa dummy.");
    }
}