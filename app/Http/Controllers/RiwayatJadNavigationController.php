<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\UnitKerja;

class RiwayatJadNavigationController extends Controller
{
    public function index()
    {
        // Riwayat JAD hanya berlaku untuk Dosen.
        $pegawais = Pegawai::with([
            'jenisPegawai',
            'unitKerja',
            'jabatanAkademik',
            'riwayatJabatanAkademiks',
        ])
            ->dosen()
            ->orderBy('nama')
            ->get();

        // Mengambil Unit Kerja tingkat atas beserta Unit Kerja turunannya.
        $unitKerjas = UnitKerja::with('children')
            ->whereNull('parent_id')
            ->orderBy('nama')
            ->get();

        return view(
            'riwayat.jabatan-akademik.index',
            compact('pegawais', 'unitKerjas')
        );
    }
}
