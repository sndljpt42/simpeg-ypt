<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Golongan;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $golongan = [
            'II' => ['A','B','C','D'],
            'III' => ['A','B','C','D'],
            'IV' => ['A','B','C','D','E'],
        ];

        //foreeach 1 membaca golongan
        foreach($golongan as $gol => $ruangs){
            //foreach 2 membaca ruang
            foreach($ruangs as $ruang){
                Golongan::updateOrCreate(
                    //Data yang diajukan acuan pencarian
                    [
                        'kode' => $gol . '/' . $ruang
                    ],

                    //data yang disimpan
                    [
                        'golongan' => $gol,
                        'ruang' => $ruang,
                        'kode' => $gol . '/' . $ruang
                    ]
                );
            }
        }
    }
}
