<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Dokumen;
use App\Http\Requests\StoreDokumenRequest;
use App\Http\Requests\UpdateDokumenRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index(Pegawai $pegawai): View
    {
        //memastikan query memang mengambil dokumen milik pegawai yang sedang dibuka serta versinya
        $dokumens = $pegawai->dokumens()
            ->with('versions')
            ->orderBy('nama')
            ->get();

        return view('pegawais.dokumen.index', compact(
            'pegawai',
            'dokumens'
        ));
    }

    public function create(Pegawai $pegawai): View
    {
        //membuat objek kosong agar form yang sama bisa digunkan untuk create
        $dokumen = new Dokumen();
        //menampilkan form untuk membuat dokumen baru milik pegawai tsb.
        return view('pegawais.dokumen.create', compact('pegawai', 'dokumen'));
    }

    public function store(StoreDokumenRequest $request, Pegawai $pegawai)
    {
        //memangil data yang lolos validasi
        $data = $request->validated();

        //menentukan pemilik dikumen berdasarkan route pegawai
        $data['pegawai_id'] = $pegawai->id;

        //menyimpan dokumen baru
        $dokumen = Dokumen::create($data);

        return redirect()->route('pegawais.dokumen.index', $pegawai)
            ->with('success', 'Dokumen "' . $dokumen->nama . '" berhasil ditambahkan');
    }

    public function edit(Pegawai $pegawai, Dokumen $dokumen): View
    {
        //memastikan dokumen memang milik pegawai yang sedang dibuka
        abort_unless($dokumen->pegawai_id === $pegawai->id, 404);
        return view('pegawais.dokumen.edit', [
            'pegawai' => $pegawai,
            'dokumen' =>$dokumen
        ]);
    }

    public function update(
        UpdateDokumenRequest $request,
        Pegawai $pegawai,
        Dokumen $dokumen
    ) {
        // Memastikan dokumen yang diedit memang milik pegawai tersebut.
        abort_unless(
            $dokumen->pegawai_id === $pegawai->id,
            404
        );

        // Mengambil data yang sudah lolos validasi.
        $data = $request->validated();

        // Memperbarui metadata dokumen.
        $dokumen->update($data);

        return redirect()
            ->route('pegawais.dokumen.index', $pegawai)
            ->with(
                'success',
                'Dokumen "' . $dokumen->nama . '" berhasil diperbarui.'
            );
    }
}
