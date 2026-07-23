<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UnitKerja;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Rektorat Universitas Pasundan'],
            ['nama' => 'Sekolah Tinggi Hukum Pasundan'],
            ['nama' => 'Sekolah Tinggi Ilmu Ekonomi Pasundan'],
            ['nama' => 'Sekolah Tinggi Keguruan dan Ilmu Pendidikan Pasundan'],
            ['nama' => 'Fakultas Hukum Universitas Pasundan'],
            ['nama' => 'Fakultas Ilmu Sosial dan Ilmu Politik Universitas Pasundan'],
            ['nama' => 'Fakultas Ekonomi dan Bisnis Universitas Pasundan'],
            ['nama' => 'Fakultas Keguruan dan Ilmu Pendidikan Universitas Pasundan'],
            ['nama' => 'Fakultas Teknik Universitas Pasundan'],
            ['nama' => 'Fakultas Ilmu Seni dan Sastra Universitas Pasundan'],
            ['nama' => 'Fakultas Kedokteran Universitas Pasundan'],
            ['nama' => 'Program Pascasarjana Universitas Pasundan'],
        ];

        foreach($data as $item){
            UnitKerja::updateOrCreate(
                ['nama' => $item['nama']],

                $item
            );   
        }
    }
}
