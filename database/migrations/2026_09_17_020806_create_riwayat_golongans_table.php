<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel riwayat_golongans.
     *
     * Satu baris pada tabel ini mewakili satu SK
     * kenaikan golongan milik seorang pegawai.
     */
    public function up(): void
    {
        Schema::create('riwayat_golongans', function (Blueprint $table) {
            // ID unik untuk setiap riwayat golongan.
            $table->id();

            // Menghubungkan riwayat dengan pegawai yang bersangkutan.
            $table->foreignId('pegawai_id')
                ->constrained('pegawais')
                ->cascadeOnDelete();

            // Menghubungkan riwayat dengan master golongan.
            $table->foreignId('golongan_id')
                ->constrained('golongans')
                ->restrictOnDelete();

            // Nomor SK yang menjadi dasar riwayat ini.
            $table->string('nomor_sk', 100);

            // Tanggal ketika SK diterbitkan.
            $table->date('tanggal_sk');

            // Tanggal mulai berlakunya golongan.
            $table->date('tmt');

            // Catatan tambahan jika diperlukan.
            $table->text('keterangan')->nullable();

            // created_at dan updated_at.
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
        Schema::dropIfExists('riwayat_golongans');
    }
};