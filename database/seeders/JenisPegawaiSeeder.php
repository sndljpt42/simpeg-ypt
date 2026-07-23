<?php

namespace Database\Seeders;

use App\Models\JenisPegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Dosen'],
            ['nama' => 'Tenaga Kependidikan']
        ];

        foreach($data as $item){

            // Jika sudah ada berdasarkan nama → update
            // Jika belum ada → insert

            JenisPegawai::updateOrCreate(
                ['nama' => $item['nama']],

                $item
            );
        }
    }
}
