<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRiwayatJabatanAkademikRequest;
use App\Http\Requests\UpdateRiwayatJabatanAkademikRequest;
use App\Models\Pegawai;
use App\Models\RiwayatJabatanAkademik;
use App\Services\PegawaiFormService;
use Illuminate\Http\Request;

class RiwayatJabatanAkademikController extends Controller
{
    public function index(Pegawai $pegawai)
    {
        //ambil riwayat milik pegawai yang sedang dibuka
        $riwayatJabatanAkademiks = $pegawai->riwayatJabatanAkademiks()
            ->with('jabatanAkademik') //mengambil data master jabatan akademik
            ->get();

        return view('riwayat-jabatan-akademik.index', [
            'pegawai' => $pegawai,
            'riwayatJabatanAkademiks' => $riwayatJabatanAkademiks,
        ]);
    }

    public function create(Pegawai $pegawai, PegawaiFormService $formService)
    {
        //ambil data master yang dibutuhkan
        $masterData = $formService->getRiwayatJabatanAkademikFormData();

        return view('riwayat-jabatan-akademik.create', [
            'pegawai' => $pegawai,
            'jabatanAkademiks' => $masterData['jabatanAkademiks'],
        ]);
    }

    public function store(StoreRiwayatJabatanAkademikRequest $request, Pegawai $pegawai)
    {
        //ambil data yang sudah lolos validasi

        $data = $request->validated();

        //pegawai ditentukan dari URL,atau berdasarkan pegawai yang sedang kita buka
        $data['pegawai_id'] = $pegawai->id;

        RiwayatJabatanAkademik::create($data);

        return redirect()->route('pegawais.riwayat-jabatan-akademik.index', $pegawai)
            ->with('success', 'Riwata Jabatan Akademik "' . $pegawai->nama . '" berhasil ditambahkan');
    }

    public function show(Pegawai $pegawai, RiwayatJabatanAkademik $riwayatJabatanAkademik)
    {
        // Pastikan riwayat yang dibuka memang milik
        // pegawai yang sedang kita lihat.
        abort_unless(
            $riwayatJabatanAkademik->pegawai_id === $pegawai->id,
            404
        );

        // Tampilkan halaman detail riwayat.
        return view('riwayat-jabatan-akademik.show', [
            'pegawai' => $pegawai,
            'riwayatJabatanAkademik' => $riwayatJabatanAkademik,
        ]);
    }

    public function edit(
        Pegawai $pegawai,
        RiwayatJabatanAkademik $riwayatJabatanAkademik,
        PegawaiFormService $formService
    ) {
        // Pastikan riwayat memang milik pegawai yang sedang dibuka.
        abort_unless(
            $riwayatJabatanAkademik->pegawai_id === $pegawai->id,
            404
        );

        // Ambil data master untuk dropdown Jabatan Akademik.
        $masterData = $formService->getRiwayatJabatanAkademikFormData();

        return view('riwayat-jabatan-akademik.edit', [
            'pegawai' => $pegawai,
            'riwayatJabatanAkademik' => $riwayatJabatanAkademik,
            'jabatanAkademiks' => $masterData['jabatanAkademiks'],
        ]);
    }


    /**
     * Memperbarui riwayat jabatan akademik.
     */
    public function update(
        UpdateRiwayatJabatanAkademikRequest $request,
        Pegawai $pegawai,
        RiwayatJabatanAkademik $riwayatJabatanAkademik
    ) {
        // Pastikan riwayat memang milik pegawai yang sedang dibuka.
        abort_unless(
            $riwayatJabatanAkademik->pegawai_id === $pegawai->id,
            404
        );

        // Ambil hanya data yang sudah lolos validasi.
        $data = $request->validated();

        $riwayatJabatanAkademik->update($data);

        return redirect()
            ->route(
                'pegawais.riwayat-jabatan-akademik.index',
                $pegawai
            )
            ->with(
                'success',
                'Riwayat Jabatan Akademik "' .
                    $pegawai->nama .
                    '" berhasil diperbarui.'
            );
    }

    /**
     * Menghapus riwayat jabatan akademik.
     */
    public function destroy(
        Pegawai $pegawai,
        RiwayatJabatanAkademik $riwayatJabatanAkademik
    ) {
        // Pastikan riwayat memang milik pegawai yang sedang dibuka.
        abort_unless(
            $riwayatJabatanAkademik->pegawai_id === $pegawai->id,
            404
        );

        // Hapus data riwayat jabatan akademik.
        $riwayatJabatanAkademik->delete();

        // Kembali ke halaman index setelah berhasil dihapus.
        return redirect()
            ->route(
                'pegawais.riwayat-jabatan-akademik.index',
                $pegawai
            )
            ->with(
                'success',
                'Riwayat Jabatan Akademik "' .
                    $pegawai->nama .
                    '" berhasil dihapus.'
            );
    }
}
