<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * MIGRATION: BUAT TABEL PERUSAHAAN
 * ==================================
 * Migration = file yang mendeskripsikan struktur tabel di database.
 * File ini "membuat" tabel 'perusahaans'.
 *
 * CARA JALANIN:
 *   php artisan migrate
 *
 * CARA BALIKIN:
 *   php artisan migrate:rollback
 *
 * STRUKTUR TABEL YANG DIHASILKAN:
 * | id | nama_perusahaan | bidang_usaha | alamat | nama_pembimbing_industri | telepon | created_at | updated_at |
 */
return new class extends Migration
{
    /**
     * up() = apa yang dilakukan saat migration DIJALANKAN.
     * Di sini: buat tabel 'perusahaans' dengan kolom-kolomnya.
     */
    public function up(): void
    {
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();                                          // Kolom auto-increment (1, 2, 3, ...)
            $table->string('nama_perusahaan', 100);                // varchar(100) — nama PT/CV
            $table->string('bidang_usaha', 100);                   // varchar(100) — bidang usaha
            $table->text('alamat');                                // text — alamat panjang
            $table->string('nama_pembimbing_industri', 100)->nullable(); // varchar(100), boleh kosong
            $table->string('telepon', 20)->nullable();             // varchar(20), boleh kosong
            $table->timestamps();                                  // Otomatis buat created_at + updated_at
        });
    }

    /**
     * down() = apa yang dilakukan saat migration DI-ROLLBACK.
     * Di sini: hapus tabel 'perusahaans'.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaans');
    }
};
