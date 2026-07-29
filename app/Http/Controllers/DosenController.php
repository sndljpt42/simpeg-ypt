<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Pegawai;
use App\Models\Agama;
use App\Models\Golongan;
use App\Models\Pendidikan;
use App\Models\StatusPegawai;
use App\Models\UnitKerja;  
use App\Models\JabatanAkademik;
use App\Models\JenisPegawai;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //mengambil data dosen dan relasinya
        //earger loading digunakan untuk menghindaarin N+1 problem
        $dosens = Pegawai::with([
            'agama',
            'pendidikan',
            'unitKerja',
            'golongan',
            'jabatanAkademik',
            'statusPegawai',
            'jenisPegawai',
        ])
        ->dosen()
        ->orderBy('nama')
        ->get();

        //mengirim data dosen kehalaman index dosen

        return view('dosen.index', compact('dosens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //mengambil seluruh data master untuk dropdown
        //diurutkan berdasarkan nama agar mudah dipilih
        $agamas = Agama::orderBy('nama')->get();
        $pendidikans = Pendidikan::orderBy('nama')->get();
        $unitKerjas = UnitKerja::orderBy('nama')->get();
        $golongans = Golongan::orderBy('kode')->get();
        $jabatanAkademiks = JabatanAkademik::orderBy('nama')->get();
        $statusPegawais = StatusPegawai::orderBy('nama')->get();

        //mengambil ID jenis pegawai "Dosen"
        //nanri digunakan sebagai hidden input
        //agar pengguna tidak perlu memilih jenis pegawai secara manual

        $jenisPegawais = JenisPegawai::where('nama', 'Dosen')->first();

        return view('dosen.create', compact(
            'agamas',
            'pendidikans',
            'unitKerjas',
            'golongans',
            'jabatanAkademiks',
            'statusPegawais',
            'jenisPegawais'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePegawaiRequest $request)
    {
        //seluruh data sdudah divalidai oleh StorePegawaiRequest
        //validate hanya mengembalikan data yang lolos validasi, sehingga aman untuk langsung disimpan ke database
        $data = $request->validated();

       // menyimpan ke tabel pegawai
       Pegawai::create($data);

       return redirect()
            ->route('dosen.index')
            ->with('success', 'Data Dosen Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $dosen): View
    {
        //Supaya nanti tidak terjadi N+1 Query
        //Dengan load(), semua relasi diambil di awal sehingga halaman lebih efisien.
        $dosen->load([
            'agama',
            'pendidikan',
            'unitKerja',
            'statusPegawai',
            'golongan',
            'jabatanAkademik',
            'jenisPegawai'
        ]);

        return view('dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $dosen): View
    {
        // mengambil seluruh data master
        $agamas = Agama::orderBy('nama')->get();
        $pendidikans = Pendidikan::orderBy('nama')->get();
        $unitKerjas = UnitKerja::orderBy('nama')->get();
        $golongans = Golongan::orderBy('kode')->get();
        $jabatanAkademiks = JabatanAkademik::orderBy('nama')->get();
        $statusPegawais = StatusPegawai::orderBy('nama')->get();

        $jenisPegawais = JenisPegawai::where('nama', 'Dosen')->first();  

        return view('dosen.edit', compact(
            'dosen',
            'agamas',
            'pendidikans',
            'unitKerjas',
            'golongans',
            'jabatanAkademiks',
            'statusPegawais',
            'jenisPegawais'

        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePegawaiRequest $request, Pegawai $dosen)
    {
        //mengambil hanya data yang lolos validasi

        $data = $request->validated();

        //memperbaharui dosen
        $dosen->update($data);

        //kembali ke halaman daftar dosen
        return redirect()
            ->route('dosen.index')
            ->with('success', 'Data dosen berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
