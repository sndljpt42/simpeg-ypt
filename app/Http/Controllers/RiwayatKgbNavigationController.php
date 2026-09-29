<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\UnitKerja;

class RiwayatKgbNavigationController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::with([
            'jenisPegawai',
            'unitKerja',
            'riwayatKGBs',
        ])
            ->orderBy('nama')
            ->get();

        // Mengambil Unit Kerja tingkat atas beserta Unit Kerja turunannya.
        $unitKerjas = UnitKerja::with('children')
            ->whereNull('parent_id')
            ->orderBy('nama')
            ->get();

        return view(
            'riwayat.kgb.index',
            compact('pegawais', 'unitKerjas')
        );
    }
}
