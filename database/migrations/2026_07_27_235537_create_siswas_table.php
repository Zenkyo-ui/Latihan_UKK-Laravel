<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * MIGRATION: BUAT TABEL SISWA
 * =============================
 * Tabel ini menyimpan data siswa yang melaksanakan PKL.
 *
 * RELASI DENGAN TABEL LAIN:
 *   siswas.perusahaan_id → perusahaans.id (FK, cascade delete)
 *   siswas.kompetensi_id → kompetensis.id (FK, null on delete)
 *
 * STRUKTUR TABEL:
 * | id | nis | nama | kelas | tanggal_mulai_pkl | tanggal_selesai_pkl | perusahaan_id | kompetensi_id | created_at | updated_at |
 *
 * CATATAN:
 * - 'cascade' di onDelete = kalau perusahaan dihapus, siswa terkait juga ikut hapus.
 * - 'nullOnDelete' di kompetensi_id = kalau kompetensi dihapus, kolom jadi NULL (siswa tidak hapus).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 20)->unique();          // NIS harus unik (tidak boleh duplikat)
            $table->string('nama', 100);
            $table->string('kelas', 30);
            $table->date('tanggal_mulai_pkl');
            $table->date('tanggal_selesai_pkl');

            // Foreign Key → tabel perusahaans
            // constrained('perusahaans') = pastikan ID yang diisi ada di tabel perusahaans
            // onDelete('cascade') = hapus siswa juga kalau perusahaan dihapus
            $table->foreignId('perusahaan_id')
                    ->constrained('perusahaans')
                    ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
