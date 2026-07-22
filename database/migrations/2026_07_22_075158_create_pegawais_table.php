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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_pegawai',['Dosen','Tendik']);
            $table->string('nama');
            $table->string('nipy')->unique();
            $table->string('nidn')->nullable();
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin',['L','P']);
            $table->foreignId('agama_id')->constrained('agamas');
            $table->date('tmt');
            $table->foreignID('pendidikan_id')->constrained('pendidikans');
            $table->foreignID('unit_kerja_id')->constrained('unit_kerjas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
