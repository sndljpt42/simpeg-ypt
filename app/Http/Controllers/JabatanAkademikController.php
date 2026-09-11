<?php

namespace App\Http\Controllers;

use App\Models\JabatanAkademik;
use App\Models\Golongan;
use App\Http\Requests\StoreJabatanAkademikRequest;
use App\Http\Requests\UpdateJabatanAkademikRequest;
use Illuminate\Http\Request;

class JabatanAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ambil semua data jabatan akademik
        $jabatanAkademiks = JabatanAkademik::query()
            ->with('golonganMin')
            ->with('golonganMax')
            ->orderBy('nama')
            ->get();

        return view('jabatan-akademik.index', compact('jabatanAkademiks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil seluruh Golongan untuk pilihan Golongan minimal.
        $golongans = Golongan::orderBy('kode')->get();

        // Mengirim data Golongan ke halaman Create.
        return view(
            'jabatan-akademik.create',
            compact('golongans')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJabatanAkademikRequest $request)
    {
        // Mengambil hanya data yang sudah lolos validasi.
        $data = $request->validated();

        // Menyimpan Jabatan Akademik baru ke database.
        $jabatanAkademik = JabatanAkademik::create($data);

        // Kembali ke halaman Index dengan flash message yang menyebut nama Jabatan Akademik.
        return redirect()
            ->route('jabatan-akademik.index')
            ->with(
                'success',
                'Jabatan Akademik "' . $jabatanAkademik->nama . '" berhasil ditambahkan.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(JabatanAkademik $jabatanAkademik)
    {
        // Mengambil data Jabatan Akademik beserta relasi Golongan Minimal.
        $jabatanAkademik->load('golonganMin');

        // Mengambil data relasi Golongan Maksimal.
        $jabatanAkademik->load('golonganMax');

        // Mengirim data Jabatan Akademik ke halaman Detail.
        return view(
            'jabatan-akademik.show',
            compact('jabatanAkademik')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JabatanAkademik $jabatanAkademik)
    {
        // Mengambil seluruh Golongan untuk pilihan pada form Edit.
        $golongans = Golongan::orderBy('kode')->get();

        // Mengirim Jabatan Akademik yang akan diedit
        // beserta daftar Golongan ke halaman Edit.
        return view('jabatan-akademik.edit', compact('jabatanAkademik', 'golongans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateJabatanAkademikRequest $request,
        JabatanAkademik $jabatanAkademik
    ) {
        // Mengambil hanya data yang sudah lolos validasi UpdateJabatanAkademikRequest.
        $data = $request->validated();

        // Memperbarui data Jabatan Akademik menggunakan data yang sudah divalidasi.
        $jabatanAkademik->update($data);

        // Menyimpan nama Jabatan Akademik terbaru untuk flash message.
        $namaJabatanAkademik = $jabatanAkademik->nama;

        // Kembali ke halaman Index dengan flash message berhasil.
        return redirect()
            ->route('jabatan-akademik.index')
            ->with(
                'success',
                'Jabatan Akademik "' . $namaJabatanAkademik . '" berhasil diperbarui.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JabatanAkademik $jabatanAkademik)
    {
        // Menyimpan nama Jabatan Akademik sebelum kemungkinan dihapus.
        $namaJabatanAkademik = $jabatanAkademik->nama;

        // Memeriksa apakah Jabatan Akademik masih digunakan oleh data Dosen/Pegawai.
        $digunakanDosen = $jabatanAkademik->dosens()->exists();

        // Jika masih digunakan, data tidak boleh dihapus.
        if ($digunakanDosen) {
            return redirect()
                ->route('jabatan-akademik.index')
                ->with(
                    'error',
                    'Jabatan Akademik "' . $namaJabatanAkademik . '" tidak boleh dihapus karena masih digunakan oleh data Dosen.'
                );
        }

        // Jika tidak digunakan, Jabatan Akademik dapat dihapus.
        $jabatanAkademik->delete();

        // Kembali ke halaman Index dengan flash message berhasil.
        return redirect()
            ->route('jabatan-akademik.index')
            ->with(
                'success',
                'Jabatan Akademik "' . $namaJabatanAkademik . '" berhasil dihapus.'
            );
    }
}
