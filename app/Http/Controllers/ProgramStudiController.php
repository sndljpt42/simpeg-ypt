<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ProgramStudi;
use App\Models\UnitKerja;
use App\Http\Requests\StoreProgramStudiRequest;
use App\Http\Requests\UpdateProgramStudiRequest;

class ProgramStudiController extends Controller
{

    public function index()
    {
        // Mengambil Program Studi beserta relasi Unit Kerja.
        // Eager loading digunakan agar nama Unit Kerja dapat ditampilkan
        // tanpa query tambahan untuk setiap baris.
        $programStudis = ProgramStudi::with('unitKerja')
            ->orderBy(UnitKerja::select('nama')->whereColumn('unit_kerjas.id', 'program_studis.unit_kerja_id'))
            ->orderBy('nama')
            ->get();

        // Mengirim data Program Studi ke halaman Index.
        return view('program-studi.index', compact('programStudis'));
    }

    public function create()
    {
        // Mengambil seluruh Unit Kerja untuk pilihan pada form Program Studi.
        $unitKerjas = UnitKerja::orderBy('nama')->get();

        // Mengirim data Unit Kerja ke halaman Create Program Studi.
        return view('program-studi.create', compact('unitKerjas'));
    }

    public function store(StoreProgramStudiRequest $request)
    {
        // Mengambil hanya data yang sudah lolos validasi.
        $data = $request->validated();

        // Menyimpan Program Studi baru ke database.
        $programStudi = ProgramStudi::create($data);

        // Kembali ke halaman Index dengan flash message yang menyebut nama Program Studi.
        return redirect()
            ->route('program-studi.index')
            ->with(
                'success',
                'Program Studi "' . $programStudi->nama . '" berhasil ditambahkan.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramStudi $programStudi)
    {
        // Memuat relasi Unit Kerja agar nama Unit Kerja tersedia
        $programStudi->load('unitKerja');

        // Mengirim data Program Studi ke halaman detail.
        return view('program-studi.show', compact('programStudi'));
    }

    /**
     * Show the form for editing the specified resource.
     * ProgramStudi $programStudi menggunakan Route Model Binding
     */
    public function edit(ProgramStudi $programStudi)
    {
        // Mengambil seluruh Unit Kerja untuk pilihan pada form Edit.
        $unitKerjas = UnitKerja::orderBy('nama')->get();

        // Mengirim Program Studi yang akan diedit
        // beserta daftar Unit Kerja ke halaman Edit.
        return view('program-studi.edit', compact(
            'programStudi',
            'unitKerjas'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateProgramStudiRequest $request,
        ProgramStudi $programStudi
    ) {
        // Mengambil hanya data yang sudah lolos validasi.
        $data = $request->validated();

        // Memperbarui data Program Studi dengan data yang sudah divalidasi.
        $programStudi->update($data);

        // Mengambil nama Program Studi terbaru setelah proses update.
        $namaProgramStudi = $programStudi->nama;

        // Kembali ke halaman Index dengan flash message yang menyebut nama Program Studi.
        return redirect()
            ->route('program-studi.index')
            ->with(
                'success',
                'Program Studi "' . $namaProgramStudi . '" berhasil diperbarui.'
            );
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramStudi $programStudi)
    {
        // Menyimpan nama Program Studi sebelum data dihapus.
        // Nama ini digunakan untuk flash message setelah proses selesai.
        $namaProgramStudi = $programStudi->nama;

        // Memeriksa apakah Program Studi masih digunakan oleh data Pegawai.
        $digunakanPegawai = $programStudi->pegawais()->exists();

        // Jika masih digunakan Pegawai, penghapusan tidak diperbolehkan.
        if ($digunakanPegawai) {

            // Kembali ke Index dengan pesan error yang menyebut nama Program Studi.
            return redirect()
                ->route('program-studi.index')
                ->with(
                    'error',
                    'Program Studi "' . $namaProgramStudi . '" tidak boleh dihapus karena masih digunakan oleh data Pegawai.'
                );
        }

        // Menghapus Program Studi secara permanen karena master tidak menggunakan Soft Delete.
        $programStudi->delete();

        // Kembali ke Index dengan flash message yang menyebut nama Program Studi.
        return redirect()
            ->route('program-studi.index')
            ->with(
                'success',
                'Program Studi "' . $namaProgramStudi . '" berhasil dihapus.'
            );
    }

    public function byUnitKerja(UnitKerja $unitKerja): JsonResponse
    {
        $programStudis = $unitKerja->programStudis()
            ->orderBy('nama')
            ->get([
                'id',
                'nama',
            ]);

        return response()->json($programStudis);
    }
}
