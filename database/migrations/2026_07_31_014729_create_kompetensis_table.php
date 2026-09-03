<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * MIGRATION: BUAT TABEL KOMPETENSI
 * ===================================
 * Tabel ini menyimpan daftar bidang keahlian (PPLG, TKJ, MM, dll).
 *
 * STRUKTUR TABEL:
 * | id | nama_kompetensi | deskripsi | created_at | updated_at |
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kompetensis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kompetensi');   // Contoh: "PPLG", "TKJ"
            $table->text('deskripsi')->nullable();     // Deskripsi, boleh kosong
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kompetensis');
    }
};

    return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kompetensi', function (Blueprint $table) {
            $table->id();

            $table->string('nama_kompetensi');

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kompetensi');
    }
};
