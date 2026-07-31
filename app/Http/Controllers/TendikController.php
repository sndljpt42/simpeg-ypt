<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\Pegawai;
use App\Models\JenisPegawai;
use Illuminate\View\View;
use App\Services\PegawaiFormService;

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

    private PegawaiFormService $pegawaiFormService;

    public function __construct(PegawaiFormService $pegawaiFormService)
    {
        $this->pegawaiFormService = $pegawaiFormService;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisPegawais = JenisPegawai::where('nama', JenisPegawai::TENDIK)->first();

        return view('tendik.create', array_merge(
            $this->pegawaiFormService->getMasterData(),
            [
                'jenisPegawais' => $jenisPegawais,
            ]
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
        return view('tendik.edit', array_merge(
            $this->pegawaiFormService->getMasterData(),
            [
                'tendik' => $tendik,
            ]
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
    public function destroy(Pegawai $tendik)
    {
        $tendik->delete();

        return redirect()
        ->route('tendik.index')
        ->with('success', 'Data tenaga kependidikan berhasil dihapus');
    }
}
