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
            $table->foreignId('jenis_pegawai_id')->constrained('jenis_pegawais');
            $table->string('nama');
            $table->string('nipy')->unique();
            $table->string('nidn')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin',['L','P']);
            $table->foreignId('agama_id')->constrained('agamas');
            $table->date('tmt');
            $table->foreignID('pendidikan_id')->constrained('pendidikans');
            $table->foreignID('unit_kerja_id')->constrained('unit_kerjas');
            $table->foreignId('golongan_id')->nullable()->constrained('golongans');
            $table->foreignId('jabatan_akademik_id')->nullable()->constrained('jabatan_akademiks');
            $table->foreignId('status_pegawai_id')->constrained('status_pegawais');
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
