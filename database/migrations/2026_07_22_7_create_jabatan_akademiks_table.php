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
        Schema::create('jabatan_akademiks', function (Blueprint $table) {
            $table->id();
            // AA/L/LK/GB
            $table->string('nama', 100);
            $table->foreignId('golongan_min_id')->constrained('golongans');
            $table->foreignId('golongan_max_id')->constrained('golongans');
            $table->unsignedTinyInteger('usia_pensiun');
            $table->unsignedTinyInteger('maks_kgb_setelah_mentok')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_akademiks');
    }
};
