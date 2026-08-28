<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * MIGRATION: TABEL PIVOT SISWA - SKILL
 * ======================================
 * Tabel perantara (pivot) untuk relasi MANY-TO-MANY antara siswa & skill.
 *
 * KENAPA PERLU PIVOT?
 * - 1 siswa bisa menguasai BANYAK skill.
 * - 1 skill bisa dikuasai oleh BANYAK siswa.
 * → Ini relasi many-to-many, jadi butuh tabel penyambung (pivot).
 *
 * Setiap baris di sini = 1 pasangan (siswa, skill).
 * Contoh: | siswa_id=3 | skill_id=2 |  artinya siswa #3 menguasai skill #2.
 *
 * STRUKTUR TABEL:
 * | id | siswa_id | skill_id | created_at | updated_at |
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('skill_id')->constrained('skills')->onDelete('cascade');
            $table->timestamps();

            // Cegah duplikat pasangan (siswa yang sama + skill yang sama)
            $table->unique(['siswa_id', 'skill_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa_skill');
    }
};
