<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRiwayatGolonganRequest;
use App\Http\Requests\UpdateRiwayatGolonganRequest;
use Illuminate\Http\Request;
use App\Models\RiwayatGolongan;
use App\Models\Pegawai;
use App\Services\PegawaiFormService;

class RiwayatGolonganController extends Controller
{
    //Menampilkan seluruh riwayat golongan.
    public function index(Pegawai $pegawai)
    {
        // Ambil history berdasarkan pegawai yang sedang dibuka.

        $riwayatGolongans = $pegawai->riwayatGolongans()
            ->with('golongan')
            ->get();

        return view('riwayat-golongan.index', [
            'pegawai' => $pegawai,
            'riwayatGolongans' => $riwayatGolongans,
        ]);
    }

    public function create(Pegawai $pegawai, PegawaiFormService $formService)
    {
        // Ambil data master yang diperlukan oleh form.
        $masterData = $formService->getRiwayatGolonganFormData();


        return view('riwayat-golongan.create', [
            'pegawai' => $pegawai,
            'golongans' => $masterData['golongans'],

        ]);
    }

    public function store(StoreRiwayatGolonganRequest $request, Pegawai $pegawai)
    {
        // ambil data yang lolos validasi
        $data = $request->validated();
        $namaPegawai = $pegawai->nama;
        //pegawai ditentukan dari URL, bukan dari input form
        $data['pegawai_id'] = $pegawai->id;

        RiwayatGolongan::create($data);

        return redirect()
            ->route('pegawais.riwayat-golongan.index', $pegawai)
            ->with('success', 'Riwayat Golonngan "' . $namaPegawai . '"  berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu riwayat golongan.
     */
    public function show(Pegawai $pegawai, RiwayatGolongan $riwayatGolongan)
    {
        // Pastikan riwayat yang dibuka memang milik
        // pegawai yang sedang kita lihat.
        abort_unless(
            $riwayatGolongan->pegawai_id === $pegawai->id,
            404
        );

        return view('riwayat-golongan.show', [
            'pegawai' => $pegawai,
            'riwayatGolongan' => $riwayatGolongan,
        ]);
    }

    /**
     * Menampilkan form untuk mengubah riwayat golongan.
     */
    public function edit(
        Pegawai $pegawai,
        RiwayatGolongan $riwayatGolongan,
        PegawaiFormService $formService
    ) {
        // Pastikan history tersebut benar-benar milik pegawai.
        abort_unless(
            $riwayatGolongan->pegawai_id === $pegawai->id,
            404
        );

        // Ambil master Golongan untuk dropdown.
        $masterData = $formService->getRiwayatGolonganFormData();

        return view('riwayat-golongan.edit', [
            'pegawai' => $pegawai,
            'riwayatGolongan' => $riwayatGolongan,
            'golongans' => $masterData['golongans'],
        ]);
    }

    /**
     * Memperbarui riwayat golongan.
     */
    public function update(UpdateRiwayatGolonganRequest $request, Pegawai $pegawai, RiwayatGolongan $riwayatGolongan)
    {
        //pastikan riwayat yang diedit memang milik pegawai tsb.
        abort_unless($riwayatGolongan->pegawai_id === $pegawai->id, 404);

        //ambil data yang sudah lolos validasi
        $data = $request->validated();

        $riwayatGolongan->update($data);

        $namaPegawai = $pegawai->nama;

        return redirect()
            ->route('pegawais.riwayat-golongan.index', $pegawai)
            ->with('success', 'riwayat golongan"' . $namaPegawai . '" berhasil di perbaharui');
    }

    /**
     * Menghapus riwayat golongan.
     */
    public function destroy(Pegawai $pegawai, RiwayatGolongan $riwayatGolongan)
    {
        // Pastikan history yang akan dihapus memang milik
        // pegawai yang sedang diproses.
        abort_unless(
            $riwayatGolongan->pegawai_id === $pegawai->id,
            404
        );

        $riwayatGolongan->delete();

        return redirect()
            ->route('pegawais.riwayat-golongan.index', $pegawai)
            ->with('success', 'Riwayat golongan berhasil dihapus.');
    }
}
