<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan Universitas Pasundan sebagai Unit Kerja induk
     * dan mengatur Unit Kerja turunannya.
     */
    public function up(): void
    {
        DB::table('unit_kerjas')->insert([
            'nama' => 'Universitas Pasundan',
            'parent_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //ambil id universitas pasundan
        $universitasPasundanId = DB::table('unit_kerjas')
            ->where('nama', 'Universitas Pasundan')
            ->value('id');

        $unitKerjaAnak = [
            'Rektorat Universitas Pasundan',
            'Fakultas Hukum Universitas Pasundan',
            'Fakultas Ilmu Sosial dan Ilmu Politik Universitas Pasundan',
            'Fakultas Ekonomi dan Bisnis Universitas Pasundan',
            'Fakultas Keguruan dan Ilmu Pendidikan Universitas Pasundan',
            'Fakultas Teknik Universitas Pasundan',
            'Fakultas Ilmu Seni dan Sastra Universitas Pasundan',
            'Fakultas Kedokteran Universitas Pasundan',
            'Program Pascasarjana Universitas Pasundan',
        ];

        //menghubungkan setiap unit kerja dengan unpas sebgai induk

        DB::table('unit_kerjas')
            ->whereIn('nama', $unitKerjaAnak)
            ->update([
                'parent_id' => $universitasPasundanId,
                'updated_at' => now(),
            ]);
    }

    /**
     * Mengembalikan struktur Unit Kerja seperti sebelum migration dijalankan.
     */
    public function down(): void
    {
        //mengambil id unpas
        $universitasPasundanId = DB::table('unit_kerjas')
            ->where('nama', 'Universitas Pasundan')
            ->value('id');

        // Jika Universitas Pasundan ditemukan, lepaskan terlebih dahulu
        // hubungan parent dari Unit Kerja turunannya.
        if ($universitasPasundanId) {
            DB::table('unit_kerjas')
                ->where('parent_id', $universitasPasundanId)
                ->update([
                    'parent_id' => null,
                    'updated_at' => now(),
                ]);

                // Menghapus record Universitas Pasundan yang dibuat oleh migration ini.
                DB::table('unit_kerjas')
                ->where('id', $universitasPasundanId)
                ->delete();
        }
    }
};
