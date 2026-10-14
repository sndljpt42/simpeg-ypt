<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Dokumen;
use App\Http\Requests\StoreDokumenRequest;
use App\Http\Requests\StoreDokumenVersionRequest;
use App\Http\Requests\UpdateDokumenRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

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
            'dokumen' => $dokumen
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

    public function storeVersion(
        StoreDokumenVersionRequest $request,
        Pegawai $pegawai,
        Dokumen $dokumen
    ) {
        //memastikan dokumen milik pegawai berdasarkan ruote/URL
        abort_unless($dokumen->pegawai_id === $pegawai->id, 404);

        $file = $request->file('file');

        //file disimpan di disk private dengan nama acak dari laravel
        $path = $file->store("documents/pegawai/{$pegawai->id}/{$dokumen->id}", 'local');

        // Jika penyimpanan file gagal, hentikan proses dan tampilkan pesan pada form.
        if (! $path) {
            return back()
                ->withInput()
                ->withErrors(['file' => 'File Gagal disimpan. silahkan coba kembali.']);
        }
        try {
            // Simpan metadata versi dalam transaksi database.
            $version = DB::transaction(function () use ($dokumen, $file, $path) {
                // Kunci record dokumen agar dua upload bersamaan tidak mendapat
                // nomor versi yang sama.
                $dokumenTerkunci = Dokumen::query()
                    ->lockForUpdate()
                    ->findOrFail($dokumen->id);

                // Ambil nomor versi terbesar, lalu gunakan nomor berikutnya.
                // Jika belum ada versi, hasilnya menjadi versi 1.
                $nomorVersi = (int) $dokumenTerkunci->versions()->max('version') + 1;

                // Relasi versions() mengisi dokumen_id secara otomatis.
                // Informasi file disimpan terpisah dari file fisiknya.
                return $dokumenTerkunci->versions()->create([
                    'version' => $nomorVersi,
                    'nama_file' => $file->getClientOriginalName(),
                    'path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'ukuran' => $file->getSize(),

                    // Checksum membantu mengenali isi file yang identik.
                    'checksum' => hash_file('sha256', $file->getRealPath()),
                ]);
            });
        } catch (Throwable $exception) {
            //jika transaksi db gagal, hapus file agar tidak tertinggal
            Storage::disk('local')->delete($path);
            throw $exception;
        }

        return redirect()
            ->route('pegawais.dokumen.index',$pegawai
            )->with(
                'success',
                "Versi {$version->version} untuk dokumen \"{$dokumen->nama}\" berhasil diunggah."
            );
    }

    public function createVersion(Pegawai $pegawai, Dokumen $dokumen): View
    {
        //memastikan dokumen milik pegawai berdasarkan ruote/URL
        abort_unless($dokumen->pegawai_id === $pegawai->id, 404);

        return view('pegawais.dokumen.versions.create', [
            'pegawai' => $pegawai,
            'dokumen' => $dokumen
        ]);
    }
}
