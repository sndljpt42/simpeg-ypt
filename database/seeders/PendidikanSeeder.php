<?php

namespace Database\Seeders;

use App\Models\Pendidikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //menghapus seluruh data lama
        // Pendidikan::truncate();

        //data master pendidikan
        $data = [
            ['nama'=> 'SMP', 'urutan'=>1],
            ['nama'=> 'SD', 'urutan'=>2],
            ['nama'=> 'SMA/SMK/MA', 'urutan'=>3],
            ['nama'=> 'D1', 'urutan'=>4],
            ['nama'=> 'D2', 'urutan'=>5],
            ['nama'=> 'D3', 'urutan'=>6],
            ['nama'=> 'D4', 'urutan'=>7],
            ['nama'=> 'S1', 'urutan'=>8],
            ['nama'=> 'Profesi', 'urutan'=>9],
            ['nama'=> 'S2', 'urutan'=>10],
            ['nama'=> 'Spesialis', 'urutan'=>11],
            ['nama'=> 'S3', 'urutan'=>12],
        ];

        //simpan ke database
        foreach($data as $item){
            // Jika sudah ada berdasarkan nama → update
            // Jika belum ada → insert
            Pendidikan::updateOrCreate(
                //kolom pencarian
                ['nama' => $item['nama']],

                $item
            );
        }
        
    }
}
