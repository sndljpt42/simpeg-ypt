<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan perubahan struktur database.
     */
    public function up(): void
    {
        Schema::table('pendidikans', function (Blueprint $table) {

            // Menghapus kolom urutan karena tidak digunakan dalam kebutuhan SIMPEG.
            $table->dropColumn('urutan');
        });
    }

    /**
     * Mengembalikan perubahan struktur database.
     */
    public function down(): void
    {
        Schema::table('pendidikans', function (Blueprint $table) {

            // Mengembalikan kolom urutan jika migration di-rollback.
            $table->integer('urutan');
        });
    }
};
