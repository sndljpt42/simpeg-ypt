<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRiwayatKGBRequest;
use App\Http\Requests\UpdateRiwayatKGBRequest;
use App\Models\Pegawai;
use App\Models\RiwayatKGB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RiwayatKGBController extends Controller
{
    public function index(Pegawai $pegawai): View
    {
        // Mengambil riwayat KGB hanya milik pegawai yang sedang dibuka berdasrkan tmt terbaru
        $riwayatKGBs = $pegawai->riwayatKGBs()
            ->latest('tmt')
            ->get();

        return view('riwayat-kgb.index', compact(
            'pegawai',
            'riwayatKGBs'
        ));
    }

    public function create(Pegawai $pegawai): View
    {
        return view('riwayat-kgb.create', compact('pegawai'));
    }

    public function store(StoreRiwayatKGBRequest $request, Pegawai $pegawai)
    {
        //mengambil data yang lolos validasi
        $data = $request->validated();

        $namaPegawai = $pegawai->nama;

        //menentukan pegawai berdsarkan route atau pegawai yang sedang dibuka
        $data['pegawai_id'] = $pegawai->id;

        RiwayatKGB::create($data);

        return redirect()->route('pegawais.riwayat-kgb.index', $pegawai)
            ->with('success', 'Riwayat KGB "' . $namaPegawai . '" berhasil ditambahkan');
    }
    /**
     * Menampilkan detail satu riwayat KGB.
     */
    public function show(Pegawai $pegawai, RiwayatKGB $riwayatKGB): View
    {
        // Pastikan riwayat KGB ditemukan dan memang milik pegawai.
        abort_unless(
            $riwayatKGB->pegawai_id === $pegawai->id,
            404
        );

        return view('riwayat-kgb.show', [
            'pegawai' => $pegawai,
            'riwayatKGB' => $riwayatKGB,
        ]);
    }

    public function edit(Pegawai $pegawai, RiwayatKGB $riwayat_kgb): View
    {
        //pastikan riwayat KGB yang di edit memang milik pegawai tersebut
        abort_unless($riwayat_kgb->pegawai_id === $pegawai->id, 404);

        return view('riwayat-kgb.edit', [
            'pegawai' => $pegawai,
            'riwayatKGB' => $riwayat_kgb,
        ]);
    }

    public function update(
        UpdateRiwayatKGBRequest $request,
        Pegawai $pegawai,
        RiwayatKGB $riwayat_kgb
    ) {
        //pastikan riwayat kgb yang di edit milik pegawai itu sendiri
        abort_unless($riwayat_kgb->pegawai_id === $pegawai->id, 404);


        // Mengambil data yang sudah lolos validasi.
        $data = $request->validated();

        // Memperbarui data Riwayat KGB.
        $riwayat_kgb->update($data);

        // Mengambil nama pegawai untuk pesan notifikasi.
        $namaPegawai = $pegawai->nama;

        return redirect()
            ->route('pegawais.riwayat-kgb.index', $pegawai)
            ->with(
                'success',
                'Riwayat KGB "' . $namaPegawai . '" berhasil diperbarui.'
            );
    }

    public function destroy(
        Pegawai $pegawai,
        RiwayatKGB $riwayat_kgb
    ) {
        // Pastikan riwayat KGB yang akan dihapus memang milik pegawai.
        abort_unless(
            $riwayat_kgb->pegawai_id === $pegawai->id,
            404
        );

        // Menghapus riwayat KGB dari database.
        $riwayat_kgb->delete();

        // Kembali ke daftar Riwayat KGB setelah berhasil dihapus.
        return redirect()
            ->route('pegawais.riwayat-kgb.index', $pegawai)
            ->with('success', 'Riwayat KGB berhasil dihapus.');
    }
}
