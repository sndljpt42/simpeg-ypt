<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JabatanAkademik;
use App\Models\Golongan;

class JabatanAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Master Jabatan Akademik
        $data = [

            [
                'nama'      => 'Asisten Ahli',
                'gol_min'   => 'III/B',
                'gol_max'   => 'III/B',
                'usia'      => 65,
                'maks_kgb'  => 2,
            ],

            [
                'nama'      => 'Lektor',
                'gol_min'   => 'III/C',
                'gol_max'   => 'III/D',
                'usia'      => 65,
                'maks_kgb'  => 2,
            ],

            [
                'nama'      => 'Lektor Kepala',
                'gol_min'   => 'IV/A',
                'gol_max'   => 'IV/C',
                'usia'      => 65,
                'maks_kgb'  => 2,
            ],

            [
                'nama'      => 'Guru Besar',
                'gol_min'   => 'IV/D',
                'gol_max'   => 'IV/E',
                'usia'      => 70,
                'maks_kgb'  => null,
            ],

        ];

        // Simpan ke database
        foreach ($data as $item) {

            // Cari golongan minimal
            $golMin = Golongan::where('kode', $item['gol_min'])->first();

            // Cari golongan maksimal
            $golMax = Golongan::where('kode', $item['gol_max'])->first();

            // Jika tidak ditemukan, tampilkan peringatan
            if (!$golMin || !$golMax) {

                $this->command->warn(
                    "Golongan {$item['gol_min']} atau {$item['gol_max']} belum ada."
                );

                continue;
            }

            // Simpan ke database
            JabatanAkademik::updateOrCreate(

                [
                    'nama' => $item['nama']
                ],

                [
                    'golongan_min_id' => $golMin->id,
                    'golongan_max_id' => $golMax->id,
                    'usia_pensiun' => $item['usia'],
                    'maks_kgb_setelah_mentok' => $item['maks_kgb'],
                ]

            );

        }
    }
}
