<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * MIGRATION: BUAT TABEL SKILL
 * ============================
 * Tabel ini menyimpan daftar SKILL / KEMAMPUAN bahasa pemrograman
 * yang dikuasai siswa (HTML, CSS, JavaScript, PHP, dll).
 *
 * BEDA DENGAN KOMPETENSI (JURUSAN):
 * - Kompetensi = bidang keahlian (jurusan) siswa, MISAL PPLG / TKJ / MM.
 * - Skill = kemampuan spesifik (bahasa pemrograman) yang DIKUASAI siswa.
 *   Satu siswa bisa menguasai BANYAK skill (relasi many-to-many).
 *
 * STRUKTUR TABEL:
 * | id | nama_skill | deskripsi | created_at | updated_at |
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('nama_skill', 100)->unique(); // Nama skill harus unik
            $table->text('deskripsi')->nullable();        // Keterangan (boleh kosong)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
