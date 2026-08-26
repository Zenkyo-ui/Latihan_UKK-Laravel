<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * MIGRATION: TAMBAH KOLOM kompetensi_id DI TABEL siswas
 * ======================================================
 * Ini migration "ALTER TABLE" — tidak membuat tabel baru,
 * tapi menambah kolom ke tabel yang sudah ada.
 *
 * CARA KERJA:
 * - Schema::table('siswas', ...) = modifikasi tabel 'siswas'
 * - ->after('perusahaan_id') = taruh kolom baru SETELAH kolom perusahaan_id
 * - ->nullable() = boleh NULL (siswa belum tentu punya kompetensi)
 * - ->constrained('kompetensis') = FK ke tabel kompetensis
 * - ->nullOnDelete() = kalau kompetensi dihapus, kolom ini jadi NULL
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->foreignId('kompetensi_id')
                  ->nullable()
                  ->after('perusahaan_id')
                  ->constrained('kompetensis')
                  ->nullOnDelete();
        });
    }

    /**
     * down() = cara membatalkan: hapus FK + kolom
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['kompetensi_id']);
            $table->dropColumn('kompetensi_id');
        });
    }
};
