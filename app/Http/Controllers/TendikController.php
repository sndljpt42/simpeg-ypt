<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Agama;
use App\Models\Pendidikan;
use App\Models\UnitKerja;
use App\Models\Golongan;
use App\Models\StatusPegawai;
use App\Models\JenisPegawai;
use Illuminate\View\View;

class TendikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tendiks = Pegawai::with([
            'pendidikan',
            'golongan',
            'unitKerja'
        ])
            ->tendik()
            ->orderBy('nama')
            ->get();

        return view('tendik.index', compact('tendiks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //mengambil seluruh data master untuk dropdown
        $agamas = Agama::orderBy('nama')->get();
        $pendidikans = Pendidikan::orderBy('nama')->get();
        $unitKerjas = UnitKerja::orderBy('nama')->get();
        $golongans = Golongan::orderBy('kode')->get();
        $statusPegawais = StatusPegawai::orderBy('nama')->get();

        //mengambil ID jenis Pegawai
        $jenisPegawais = JenisPegawai::where('nama', 'Tenaga Kependidikan')->first();

        return view('tendik.create', compact(
            'agamas',
            'pendidikans',
            'unitKerjas',
            'golongans',
            'statusPegawais',
            'jenisPegawais'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePegawaiRequest $request)
    {
        //mengambil data yang sudah lolos validasi
        $data = $request->validated();

        Pegawai::create($data);

        return redirect()->route('tendik.index')->with('success', 'Data Tenaga Kependidikan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $tendik): View
    {
        //Supaya nanti tidak terjadi N+1 Query
        //Dengan load(), semua relasi diambil di awal sehingga halaman lebih efisien.
        $tendik->load([
            'agama',
            'pendidikan',
            'unitKerja',
            'statusPegawai',
            'golongan',
            'jenisPegawai'
        ]);

        return view('tendik.show', compact('tendik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $tendik): View
    {
        //mengambil data master untuk dropdown
        $agamas = Agama::orderBy('nama')->get();
        $pendidikans = Pendidikan::orderBy('nama')->get();
        $unitKerjas = UnitKerja::orderBy('nama')->get();
        $golongans = Golongan::orderBy('kode')->get();
        $statusPegawais = StatusPegawai::orderBy('nama')->get();

        return view('tendik.edit', compact(
            'tendik',
            'agamas',
            'pendidikans',
            'unitKerjas',
            'golongans',
            'statusPegawais'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePegawaiRequest $request, Pegawai $tendik)
    {
        //mengambil data yang sudah lolos
        $data = $request->validated();
        // dd($request->validated());

        //update data pegawai
        $tendik->update($data);

        return redirect()->route('tendik.index')->with('success', 'Data Tenaga Kependidikan berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
