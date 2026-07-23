<?php

namespace Database\Seeders;

use App\Models\StatusPegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data = [

            ['nama' => 'Aktif'],
            ['nama' => 'Pensiun'],
            ['nama' => 'Mengundurkan Diri'],
            ['nama' => 'Meninggal Dunia'],

        ];

        //simpan ke database
        foreach($data as $item){
            // Jika sudah ada berdasarkan nama → update
            // Jika belum ada → insert
            StatusPegawai::updateOrCreate(
                //kolom pencarian
                ['nama' => $item['nama']],

                $item
            );
        }
    }
}
