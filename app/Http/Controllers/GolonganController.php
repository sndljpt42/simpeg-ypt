<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use App\Http\Requests\StoreGolonganRequest;
use App\Http\Requests\UpdateGolonganRequest;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ambil semua data golongan
        $golongans = Golongan::query()

            //Mengurutkan berdasarkan kelompok golongan
            ->orderBy('golongan')

            //mengurutkan berdasarkan ruang
            ->orderBy('ruang')

            //mengambil semua data
            ->get();

        // Mengirim data Golongan ke halaman Index.
        return view('golongan.index', compact('golongans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('golongan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGolonganRequest $request)
    {
        // Validasi data yang diterima dari request
        $data = $request->validated();

        // Membuat kode golongan berdasarkan golongan dan ruang
        $data['kode'] = $data['golongan'] . '/' . $data['ruang'];

        // Menyimpan data golongan ke database
        $golongan = Golongan::create($data);

        return redirect()->route('golongan.index')
            ->with('success', 'Golongan "' . $golongan->kode . '" berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Golongan $golongan)
    {
        return view('golongan.show', compact('golongan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Golongan $golongan)
    {
        return view('golongan.edit', compact('golongan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateGolonganRequest $request,
        Golongan $golongan
    ) {
        // Mengambil seluruh data yang sudah lolos validasi.
        $data = $request->validated();

        // Memperbarui data Golongan.
        $golongan->update($data);

        // Kembali ke halaman Index dengan pesan berhasil.
        return redirect()
            ->route('golongan.index')
            ->with(
                'success',
                'Golongan "' . $golongan->kode . '" berhasil diperbarui.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Golongan $golongan)
    {
        // Mengecek apakah Golongan masih digunakan oleh data Pegawai.
        if ($golongan->pegawais()->exists()) {
            return redirect()
                ->route('golongan.index')
                ->with(
                    'error',
                    'Golongan "' . $golongan->kode . '" tidak boleh dihapus karena masih digunakan oleh data Pegawai.'
                );
        }

        // Mengecek apakah Golongan masih digunakan sebagai batas minimal Jabatan Akademik.
        if ($golongan->jabatanAkademikMin()->exists()) {
            return redirect()
                ->route('golongan.index')
                ->with(
                    'error',
                    'Golongan "' . $golongan->kode . '" tidak boleh dihapus karena masih digunakan sebagai batas minimal Jabatan Akademik.'
                );
        }

        // Mengecek apakah Golongan masih digunakan sebagai batas maksimal Jabatan Akademik.
        if ($golongan->jabatanAkademikMax()->exists()) {
            return redirect()
                ->route('golongan.index')
                ->with(
                    'error',
                    'Golongan "' . $golongan->kode . '" tidak boleh dihapus karena masih digunakan sebagai batas maksimal Jabatan Akademik.'
                );
        }

        // Menyimpan kode sebelum record dihapus.
        $kode = $golongan->kode;

        // Menghapus data Golongan secara permanen.
        $golongan->delete();

        // Kembali ke Index dengan pesan berhasil.
        return redirect()
            ->route('golongan.index')
            ->with(
                'success',
                'Golongan "' . $kode . '" berhasil dihapus.'
            );
    }
}
