<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJenisPegawaiRequest;
use App\Http\Requests\UpdateJenisPegawaiRequest;
use App\Models\JenisPegawai;
use Illuminate\Http\Request;

class JenisPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil seluruh data Jenis Pegawai dan mengurutkannya berdasarkan nama.
        $jenisPegawais = JenisPegawai::orderBy('nama')->get();

        return view('jenis-pegawai.index', compact('jenisPegawais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis-pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJenisPegawaiRequest $request)
    {
        //mengambil data yang sudah divalidasi
        $data = $request->validated();

        //menyimpan data
        $jenisPegawai = JenisPegawai::create($data);

        //mengambul nama jenis pegawai yang baru disimpan
        $namaJenisPegawai = $jenisPegawai->nama;

        return redirect()
            ->route('jenis-pegawai.index')
            ->with('success', 'Jenis Pegawai "' . $namaJenisPegawai . '" berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisPegawai $jenisPegawai)
    {
        return view('jenis-pegawai.show', compact('jenisPegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisPegawai $jenisPegawai)
    {
        return view('jenis-pegawai.edit', compact('jenisPegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateJenisPegawaiRequest $request,
        JenisPegawai $jenisPegawai
    ) {
        // Mengambil hanya data yang sudah lolos validasi.
        $data = $request->validated();

        // Memperbarui data Jenis Pegawai.
        $jenisPegawai->update($data);

        // Mengambil nama terbaru setelah proses update.
        $namaJenisPegawai = $jenisPegawai->nama;


        return redirect()
            ->route('jenis-pegawai.index')
            ->with(
                'success',
                'Jenis Pegawai "' . $namaJenisPegawai . '" berhasil diperbarui.'
            );
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisPegawai $jenisPegawai)
    {
        // Menyimpan nama sebelum data dihapus.
        $namaJenisPegawai = $jenisPegawai->nama;

        // Memeriksa apakah Jenis Pegawai masih digunakan oleh data Pegawai.
        $digunakanPegawai = $jenisPegawai->pegawais()->exists();

        // Jika masih digunakan, Jenis Pegawai tidak boleh dihapus.
        if ($digunakanPegawai) {

            return redirect()
                ->route('jenis-pegawai.index')
                ->with(
                    'error',
                    'Jenis Pegawai "' . $namaJenisPegawai . '" tidak boleh dihapus karena masih digunakan oleh data Pegawai.'
                );
        }

        // Hard delete karena Jenis Pegawai merupakan data master.
        $jenisPegawai->delete();

        return redirect()
            ->route('jenis-pegawai.index')
            ->with(
                'success',
                'Jenis Pegawai "' . $namaJenisPegawai . '" berhasil dihapus.'
            );
    }
}
