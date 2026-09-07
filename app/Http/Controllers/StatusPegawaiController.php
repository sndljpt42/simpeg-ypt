<?php

namespace App\Http\Controllers;

use App\Models\StatusPegawai;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStatusPegawaiRequest;
use App\Http\Requests\UpdateStatusPegawaiRequest;

class StatusPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil seluruh data Status Pegawai dan mengurutkannya berdasarkan nama.
        $statusPegawais = StatusPegawai::orderBy('nama')->get();

        // Mengirim data Status Pegawai ke halaman Index.
        return view(
            'status-pegawai.index',
            compact('statusPegawais')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('status-pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusPegawaiRequest $request)
    {
        // Mengambil hanya data yang sudah lolos validasi.
        $data = $request->validated();

        // Menyimpan Status Pegawai baru ke database.
        $statusPegawai = StatusPegawai::create($data);

        // Mengambil nama Status Pegawai yang baru disimpan.
        $namaStatusPegawai = $statusPegawai->nama;

        // Kembali ke halaman Index dengan flash message.
        return redirect()
            ->route('status-pegawai.index')
            ->with(
                'success',
                'Status Pegawai "' . $namaStatusPegawai . '" berhasil ditambahkan.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusPegawai $statusPegawai)
    {
        return view(
            'status-pegawai.show',
            compact('statusPegawai')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatusPegawai $statusPegawai)
    {
        // Mengirim data Status Pegawai yang akan diedit ke halaman Edit.
        return view(
            'status-pegawai.edit',
            compact('statusPegawai')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateStatusPegawaiRequest $request,
        StatusPegawai $statusPegawai
    ) {
        // Mengambil hanya data yang sudah lolos validasi.
        $data = $request->validated();

        // Memperbarui data Status Pegawai.
        $statusPegawai->update($data);

        // Mengambil nama terbaru setelah proses update.
        $namaStatusPegawai = $statusPegawai->nama;

        // Kembali ke Index dengan flash message.
        return redirect()
            ->route('status-pegawai.index')
            ->with(
                'success',
                'Status Pegawai "' . $namaStatusPegawai . '" berhasil diperbarui.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StatusPegawai $statusPegawai)
    {
        // Simpan nama sebelum data dihapus.
        $namaStatusPegawai = $statusPegawai->nama;

        // Cek apakah Status Pegawai masih digunakan oleh data Pegawai.
        $digunakanPegawai = $statusPegawai->pegawais()->exists();

        // Jika masih digunakan, jangan hapus data master.
        if ($digunakanPegawai) {
            return redirect()
                ->route('status-pegawai.index')
                ->with(
                    'error',
                    'Status Pegawai "' . $namaStatusPegawai . '" tidak boleh dihapus karena masih digunakan oleh data Pegawai.'
                );
        }

        // Jika tidak digunakan, lakukan hard delete.
        $statusPegawai->delete();

        // Kembali ke Index dengan pesan berhasil.
        return redirect()
            ->route('status-pegawai.index')
            ->with(
                'success',
                'Status Pegawai "' . $namaStatusPegawai . '" berhasil dihapus.'
            );
    }
}
