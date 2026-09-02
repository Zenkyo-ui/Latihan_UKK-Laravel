<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * MIGRATION: TABEL PIVOT KOMPETENSI - SKILL
 * ===========================================
 * Tabel perantara (pivot) untuk relasi MANY-TO-MANY antara
 * JURUSAN (kompetensis) & SKILL (skills).
 *
 * KENAPA PERLU PIVOT?
 * - 1 skill bisa dipakai oleh BANYAK jurusan (contoh: "Logika OOP"
 *   dipakai RPL dan Mobile Development sekaligus).
 * - 1 jurusan bisa memakai BANYAK skill.
 * → Relasi many-to-many butuh tabel penyambung (pivot).
 *
 * Setiap baris = 1 pasangan (jurusan, skill).
 * Contoh: | kompetensi_id=2 | skill_id=8 |  artinya jurusan RPL pakai skill Logika OOP.
 *
 * STRUKTUR TABEL:
 * | id | kompetensi_id | skill_id | created_at | updated_at |
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kompetensi_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kompetensi_id')->constrained('kompetensis')->onDelete('cascade');
            $table->foreignId('skill_id')->constrained('skills')->onDelete('cascade');
            $table->timestamps();

            // Cegah duplikat pasangan (jurusan yang sama + skill yang sama)
            $table->unique(['kompetensi_id', 'skill_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kompetensi_skill');
    }
};