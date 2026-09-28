<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel riwayat_jabatan_akademiks.
     *
     * Satu baris pada tabel ini mewakili satu SK
     * jabatan akademik milik seorang pegawai.
     */
    public function up(): void
    {
        Schema::create('riwayat_jabatan_akademiks', function (Blueprint $table) {
            // ID unik untuk setiap riwayat jabatan akademik.
            $table->id();

            // Menghubungkan riwayat dengan pegawai yang bersangkutan.
            $table->foreignId('pegawai_id')
                ->constrained('pegawais')
                ->cascadeOnDelete();

            // Menghubungkan riwayat dengan master jabatan akademik.
            $table->foreignId('jabatan_akademik_id')
                ->constrained('jabatan_akademiks')
                ->restrictOnDelete();

            $table->string('nomor_sk', 50);

            // Tanggal ketika SK diterbitkan.
            $table->date('tanggal_sk');

            // Tanggal mulai berlakunya jabatan akademik.
            $table->date('tmt');

            $table->text('keterangan')->nullable();

            $table->timestamps();

            // Membantu pencarian history seorang pegawai
            // berdasarkan TMT.
            $table->index(['pegawai_id', 'tmt']);
        });
    }

    /**
     * Menghapus tabel jika migration di-rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_jabatan_akademiks');
    }
};