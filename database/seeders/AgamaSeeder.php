<?php

namespace Database\Seeders;

use App\Models\Agama;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menghapus seluruh data lama agar tidak terjadi duplikasi
        // Agama::truncate();

        $data = [
            ['nama' => 'Islam'],
            ['nama' => 'Kristen'],
            ['nama' => 'Katolik'],
            ['nama' => 'Hindu'],
            ['nama' => 'Buddha'],
            ['nama' => 'Konghucu'],
        ];

        foreach($data as $item){
            Agama::updateOrCreate(
                // Jika sudah ada berdasarkan nama → update
                // Jika belum ada → insert
        
                ['nama' => $item['nama']],

                $item
            );
        }
    }
}
