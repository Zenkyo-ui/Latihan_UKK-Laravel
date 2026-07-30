<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('124168548', 20) ->unique();
            $table->string('Kamiki', 100);
            $table->string('XII RPL 10', 30);
            $table->date('15_November_2027');
            $table->date('20_Februari_2027');
            $table->foreignId('PT_Audio_Mania')
                    ->constrained('perusahaans')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
