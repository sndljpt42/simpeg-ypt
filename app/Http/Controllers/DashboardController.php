<?php

namespace App\Http\Controllers;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        //menghitung jumlah pegawai dengan jenis dosen

        $jumlahDosen = Pegawai::dosen()->count();

        //menghitung jumlah pegawai dengan jenis tendik
        $jumlahTendik = Pegawai::tendik()->count();

        //mengirim dara kehalaman dashboard
        return view('dashboard', compact(
            'jumlahDosen',
            'jumlahTendik'
        ));
    }
}
