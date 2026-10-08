<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index(Pegawai $pegawai): View
    {
        //memastikan query memang mengambil dokumen milik pegawai yang sedang dibuka serta versinya
        $dokumens = $pegawai->dokumens()
            ->with('versions')
            ->orderBy('nama')
            ->get();

        return view('pegawais.dokumen.index', compact(
            'pegawai',
            'dokumens'
        ));
    }
}
