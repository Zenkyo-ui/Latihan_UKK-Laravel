<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * MIGRATION: BUAT TABEL PENILAIAN
 * ================================
 * Tabel ini menyimpan HASIL PENILAIAN PKL siswa di perusahaan.
 * Ini adalah lapisan lebih dalam setelah "kompetensi (jurusan)".
 *
 * KONSEP:
 * - 1 siswa punya 1 penilaian (1:1)
 * - Penilaian melekat pada siswanya → perusahaan diambil lewat relasi siswa
 *
 * STRUKTUR TABEL:
 * | id | siswa_id | skor | status_penguasaan | keaktifan | sikap | status_tamat | catatan | created_at | updated_at |
 *
 * CATATAN "FLEKSIBEL":
 * - status_penguasaan, keaktifan, sikap, status_tamat disimpan sebagai STRING
 *   (bukan enum database), supaya pilihan kategorinya gampang ditambah/diubah
 *   di controller tanpa perlu migrasi ulang.
 *
 * CATATAN:
 * - siswa_id UNIK → 1 siswa tidak bisa punya 2 penilaian.
 * - onDelete('cascade') → kalau siswa dihapus, penilaiannya ikut hapus.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_penilaian'); // Tanggal saat penilaian dilakukan

            // Foreign Key → tabel siswas (1 siswa = 1 penilaian, makanya unique)
            $table->foreignId('siswa_id')
                    ->unique()                 // mencegah duplikat penilaian utk siswa yg sama
                    ->constrained('siswas')
                    ->onDelete('cascade');

            $table->unsignedTinyInteger('skor');           // Nilai angka 0-100
            $table->string('status_penguasaan');           // Sangat Mahir/Mahir/Cukup/Kurang/Belum Dikuasai
            $table->string('keaktifan');                   // Sangat Baik/Baik/Cukup/Kurang
            $table->string('sikap');                       // Sangat Baik/Baik/Cukup/Kurang
            $table->string('status_tamat');                // Lulus/Tidak Lulus (manual + default otomatis)
            $table->text('catatan')->nullable();           // Catatan perusahaan (boleh kosong)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
