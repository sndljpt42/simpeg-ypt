<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUnitKerjaRequest;
use App\Http\Requests\UpdateUnitKerjaRequest;

class UnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mengambil seluruh data unit kerja
        $unitKerjas = UnitKerja::orderBy('nama')->get();
        return view('unit-kerja.index', compact('unitKerjas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('unit-kerja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitKerjaRequest $request)
    {
        // Mengambil hanya data yang sudah lolos validasi StoreUnitKerjaRequest.
        $data = $request->validated();

        // Menyimpan data Unit Kerja yang sudah divalidasi ke database.
        $unitKerja = UnitKerja::create($data);

        // Kembali ke halaman daftar Unit Kerja dengan flash message berhasil.
        return redirect()
            ->route('unit-kerja.index')
            ->with(
                'success',
                'Unit Kerja "' . $unitKerja->nama . '" berhasil ditambahkan.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(UnitKerja $unitKerja)
    {
        // Mengambil Program Studi yang dimiliki oleh Unit Kerja.
        $unitKerja->load([
            'programStudis',
        ]);

        // Mengirim data Unit Kerja beserta Program Studi ke halaman detail.
        return view('unit-kerja.show', compact('unitKerja'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnitKerja $unitKerja)
    {
        // Mengirim data Unit Kerja yang dipilih ke halaman Edit.
        return view('unit-kerja.edit', compact('unitKerja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitKerjaRequest $request, UnitKerja $unitKerja)
    {
        // Mengambil hanya data yang sudah lolos validasi UpdateUnitKerjaRequest.
        $data = $request->validated();

        // Memperbarui data Unit Kerja menggunakan data yang sudah divalidasi.
        $unitKerja->update($data);

        $namaUnitKerja = $unitKerja->nama;

        // Kembali ke halaman daftar Unit Kerja dengan flash message berhasil.
        return redirect()
            ->route('unit-kerja.index')
            ->with(
                'success',
                'Unit Kerja "' . $namaUnitKerja . '" berhasil diperbarui.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnitKerja $unitKerja)
    {
        // Menyimpan nama Unit Kerja sebelum kemungkinan dihapus.
        $namaUnitKerja = $unitKerja->nama;

        //memeriksa unitkerja apakah masih digunakan pegawai

        $digunakanPegawai = $unitKerja->pegawais()->exists();

        //jika masih, tidak boleh hapus unitkerja
        if ($digunakanPegawai) {
            return redirect()
                ->route('unit-kerja.index')
                ->with(
                    'error',
                    'Unit Kerja "' . $namaUnitKerja . '" tidak boleh dihapus karena masih digunakan oleh data Pegawai.'
                );
        }

        //jika tidak digunakan pegawai, unit kerja terhapus beserta prodi terkait karena ON CASCADE
        $unitKerja->delete();

        return redirect()
            ->route('unit-kerja.index')
            ->with(
                'success',
                'Unit Kerja "' . $namaUnitKerja . '" berhasil dihapus beserta Prodi Terkait.'
            );
    }

    public function byUnitKerja(UnitKerja $unitKerja)
    {
        return response()->json(
            $unitKerja->programStudis()->select('id', 'nama')
                ->orderBy('nama')
                ->get()
        );
    }
}
