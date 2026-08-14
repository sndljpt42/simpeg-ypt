<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan struktur baru untuk kebutuhan Dosen dan Tendik.
     */
    public function up(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {

            // NIDN sebelumnya digunakan sebagai identitas dosen.
            // Sekarang nama field tersebut menjadi NUPTK.
            // renameColumn mempertahankan data yang sudah ada.
            $table->renameColumn('nidn', 'nuptk');

            // Nomor sertifikasi dosen.
            // Nullable karena tidak semua dosen sudah memiliki Serdos.
            $table->string('no_serdos')->nullable()->after('nuptk');

            // Tanggal sertifikasi dosen.
            // Nullable karena tidak semua dosen sudah memiliki Serdos.
            $table->date('tanggal_serdos')->nullable()->after('no_serdos');

            // Jenis/status dosen: Tetap atau Tidak Tetap.
            // Nullable agar data lama tetap bisa dimigrasikan.
            $table->string('jenis_dosen')->nullable()->after('tanggal_serdos');

            // Jenis/status tenaga kependidikan.
            // Contoh: Tendik Tetap, Tendik Tidak Tetap, Tendik Outsourcing.
            $table->string('jenis_tendik')->nullable()->after('jenis_dosen');
        });
    }

    /**
     * Mengembalikan struktur database ke kondisi sebelum migration.
     */
    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {

            // Hapus kolom yang ditambahkan migration ini.
            $table->dropColumn([
                'no_serdos',
                'tanggal_serdos',
                'jenis_dosen',
                'jenis_tendik',
            ]);

            // Kembalikan nama NUPTK menjadi NIDN.
            $table->renameColumn('nuptk', 'nidn');
        });
    }
};