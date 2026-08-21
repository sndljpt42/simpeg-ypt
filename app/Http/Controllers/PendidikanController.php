<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use Illuminate\Http\Request;
use App\Http\Requests\StorePendidikanRequest;
use App\Http\Requests\UpdatePendidikanRequest;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil seluruh data Pendidikan dan mengurutkannya berdasarkan nama.
        $pendidikans = Pendidikan::orderBy('nama')->get();

        // Mengirim data Pendidikan ke halaman Index.
        return view('pendidikan.index', compact('pendidikans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pendidikan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePendidikanRequest $request)
    {
        // Mengambil hanya data yang sudah lolos validasi.
        $data = $request->validated();

        // Menyimpan data Pendidikan baru ke database.
        $pendidikan = Pendidikan::create($data);

        // Mengambil nama Pendidikan yang baru berhasil disimpan.
        $namaPendidikan = $pendidikan->nama;

        return redirect()
            ->route('pendidikan.index')
            ->with(
                'success',
                'Pendidikan "' . $namaPendidikan . '" berhasil ditambahkan.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendidikan $pendidikan)
    {
        return view('pendidikan.show', compact('pendidikan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendidikan $pendidikan)
    {
        return view('pendidikan.edit', compact('pendidikan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdatePendidikanRequest $request,
        Pendidikan $pendidikan
    ) {
        // Mengambil hanya data yang sudah lolos validasi.
        $data = $request->validated();

        // Memperbarui data Pendidikan menggunakan data yang sudah divalidasi.
        $pendidikan->update($data);

        // Mengambil nama Pendidikan terbaru setelah proses update.
        $namaPendidikan = $pendidikan->nama;

        return redirect()
            ->route('pendidikan.index')
            ->with(
                'success',
                'Pendidikan "' . $namaPendidikan . '" berhasil diperbarui.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendidikan $pendidikan)
    {
        // Menyimpan nama Pendidikan sebelum data dihapus.
        // Nama ini digunakan untuk flash message.
        $namaPendidikan = $pendidikan->nama;

        // Memeriksa apakah Pendidikan masih digunakan oleh data Pegawai.
        $digunakanPegawai = $pendidikan->pegawais()->exists();

        // Jika masih digunakan Pegawai, data tidak boleh dihapus.
        if ($digunakanPegawai) {

            // Kembali ke Index dengan pesan bahwa data masih digunakan.
            return redirect()
                ->route('pendidikan.index')
                ->with(
                    'error',
                    'Pendidikan "' . $namaPendidikan . '" tidak boleh dihapus karena masih digunakan oleh data Pegawai.'
                );
        }

        // Menghapus Pendidikan secara permanen karena master tidak menggunakan Soft Delete.
        $pendidikan->delete();

       
        return redirect()
            ->route('pendidikan.index')
            ->with(
                'success',
                'Pendidikan "' . $namaPendidikan . '" berhasil dihapus.'
            );
    }
}
