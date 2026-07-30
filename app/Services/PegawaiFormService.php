<?php

namespace App\Services;

use App\Models\Agama;
use App\Models\Golongan;
use App\Models\JabatanAkademik;
use App\Models\Pendidikan;
use App\Models\StatusPegawai;
use App\Models\UnitKerja;

class PegawaiFormService
{
    /**
     * Mengambil seluruh data master
     * yang digunakan pada form pegawai.
     */
    public function getMasterData(): array
    {
        return [
            'agamas' => Agama::orderBy('nama')->get(),
            'pendidikans' => Pendidikan::orderBy('nama')->get(),
            'unitKerjas' => UnitKerja::orderBy('nama')->get(),
            'golongans' => Golongan::orderBy('kode')->get(),
            'jabatanAkademiks' => JabatanAkademik::orderBy('nama')->get(),
            'statusPegawais' => StatusPegawai::orderBy('nama')->get(),
        ];
    }
}