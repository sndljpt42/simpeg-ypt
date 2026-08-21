<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;
// Menggunakan Form Request khusus untuk validasi saat membuat Agama.
use App\Http\Requests\StoreAgamaRequest;
use App\Http\Requests\UpdateAgamaRequest;

class AgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil seluruh data Agama dan mengurutkannya berdasarkan nama.
        $agamas = Agama::orderBy('nama')->get();

        return view('agama.index', compact('agamas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan halaman form untuk menambahkan data Agama.
        return view('agama.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgamaRequest $request)
    {
        // Mengambil hanya data yang sudah lolos validasi.
        $data = $request->validated();

        // Menyimpan data Agama baru ke database.
        $agama = Agama::create($data);

        // Kembali ke halaman Index dengan flash message
        // yang menyebut nama Agama yang berhasil dibuat.
        return redirect()
            ->route('agama.index')
            ->with(
                'success',
                'Agama "' . $agama->nama . '" berhasil ditambahkan.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Agama $agama)
    {
        return view('agama.show', compact('agama'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agama $agama)
    {
        return view('agama.edit', compact('agama'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgamaRequest $request, Agama $agama)
    {
        // Mengambil hanya data yang sudah lolos validasi.
        $data = $request->validated();

        // Memperbarui data Agama dengan data yang sudah divalidasi.
        $agama->update($data);

        // Mengambil nama Agama terbaru setelah proses update.
        $namaAgama = $agama->nama;

        return redirect()
            ->route('agama.index')
            ->with(
                'success',
                'Agama "' . $namaAgama . '" berhasil diperbarui.'
            );
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agama $agama)
    {
        // Menyimpan nama Agama sebelum data dihapus.
        // Nama ini digunakan untuk flash message.
        $namaAgama = $agama->nama;

        // Memeriksa apakah Agama masih digunakan oleh data Pegawai.
        $digunakanPegawai = $agama->pegawais()->exists();

        // Jika masih digunakan Pegawai, Agama tidak boleh dihapus.
        if ($digunakanPegawai) {

            // Kembali ke Index dengan pesan bahwa data masih digunakan.
            return redirect()
                ->route('agama.index')
                ->with(
                    'error',
                    'Agama "' . $namaAgama . '" tidak boleh dihapus karena masih digunakan oleh data Pegawai.'
                );
        }

        // Menghapus Agama secara permanen karena master tidak menggunakan Soft Delete.
        $agama->delete();

        return redirect()
            ->route('agama.index')
            ->with(
                'success',
                'Agama "' . $namaAgama . '" berhasil dihapus.'
            );
    }
}
