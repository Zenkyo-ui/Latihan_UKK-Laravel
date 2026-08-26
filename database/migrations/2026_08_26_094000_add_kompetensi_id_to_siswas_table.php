<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->foreignId('kompetensi_id')->nullable()->after('perusahaan_id')->constrained('kompetensis')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['kompetensi_id']);
            $table->dropColumn('kompetensi_id');
        });
    }
};
