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
use App\Models\DokumenVersion;
use Illuminate\Support\Facades\Redirect;
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

    public function destroy(Pegawai $pegawai, Dokumen $dokumen)
    {
        // Memastikan dokumen yang dihapus memang milik pegawai tersebut.
        abort_unless(
            (int) $dokumen->pegawai_id === (int) $pegawai->id,
            404
        );

        //repository tidak boleh dihapus selama masih memiliki versi file
        if ($dokumen->versions()->exists()) {
            return redirect()
                ->route('pegawais.dokumen.index', $pegawai)
                ->with(
                    'error',
                    'Repository "' . $dokumen->nama . '" belum dapat dihapus karena masih memiliki versi file. Hapus seluruh versinya terlebih dahulu.'
                );
        }

        $namaDokumen = $dokumen->nama;

        //hanya metadata repository yang dihapus karena tidak ada versi file
        $dokumen->delete();

        return redirect()
            ->route('pegawais.dokumen.index', $pegawai)
            ->with('success', 'Repository "' . $namaDokumen . '" berhasil dihapus.');
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
            ->route(
                'pegawais.dokumen.index',
                $pegawai
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

    public function versionHistory(Pegawai $pegawai, Dokumen $dokumen): View
    {
        //memestikan dokumen memang milik pegawai tersebut
        abort_unless($dokumen->pegawai_id === $pegawai->id, 404);

        //urutkan versi dari yang terbaru
        $versions = $dokumen->versions()->orderByDesc('version')->get();

        return view('pegawais.dokumen.versions.index', [
            'pegawai' => $pegawai,
            'dokumen' => $dokumen,
            'versions' => $versions,
        ]);
    }

    public function downloadVersion(
        Pegawai $pegawai,
        Dokumen $dokumen,
        DokumenVersion $version
    ): \Symfony\Component\HttpFoundation\BinaryFileResponse {
        // Pastikan dokumen milik pegawai pada URL.
        abort_unless(
            (int) $dokumen->pegawai_id === (int) $pegawai->id,
            404
        );

        // Pastikan versi milik dokumen pada URL.
        abort_unless(
            (int) $version->dokumen_id === (int) $dokumen->id,
            404
        );

        $disk = Storage::disk('local');

        // Pastikan file masih ada di private storage.
        abort_unless($disk->exists($version->path), 404);

        // Unduh file dengan nama aslinya.
        return response()->download(
            $disk->path($version->path),
            $version->nama_file
        );
    }

    public function previewVersion(
        Pegawai $pegawai,
        Dokumen $dokumen,
        DokumenVersion $version
    ): \Symfony\Component\HttpFoundation\BinaryFileResponse {
        // Pastikan dokumen merupakan milik pegawai pada URL.
        abort_unless(
            (int) $dokumen->pegawai_id === (int) $pegawai->id,
            404
        );

        // Pastikan versi tersebut milik dokumen pada URL.
        abort_unless(
            (int) $version->dokumen_id === (int) $dokumen->id,
            404
        );

        $disk = Storage::disk('local');

        // Hentikan proses jika file tidak ada di private storage.
        abort_unless($disk->exists($version->path), 404);

        // Periksa MIME aktual file yang tersimpan.
        $mimeType = mime_content_type($disk->path($version->path));

        $allowedMimeTypes = [
            'application/pdf',
            'image/jpeg',
            'image/png',
        ];

        abort_unless(
            in_array($mimeType, $allowedMimeTypes, true),
            404
        );

        // Sajikan file secara inline agar browser menampilkannya.
        return response()->file(
            $disk->path($version->path),
            [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline; filename="' .
                    addslashes($version->nama_file) . '"',
                'X-Content-Type-Options' => 'nosniff',
            ]
        );
    }

    public function destroyVersion(Pegawai $pegawai, Dokumen $dokumen, DokumenVersion $version)
    {
        //pastikan dokumen milik pegawai berdasarkan route/url
        abort_unless((int) $dokumen->pegawai_id === (int) $pegawai->id, 404);

        //cegah versi dari dokumen lain dihapus melalui url ini
        abort_unless((int) $version->dokumen_id === (int) $dokumen->id, 404);

        $disk = Storage::disk('local');
        $path = $version->path;

        //hapus file dari storage
        if ($disk->exists($path)) {
            $disk->delete($path);
        }

        //hapus catatan versi dari database
        $version->delete();

        return redirect()
            ->route('pegawais.dokumen.versions.index', [
                'pegawai' => $pegawai->id,
                'dokumen' => $dokumen->id,
            ])
            ->with('success', "Versi {$version->version} berhasil dihapus.");
    }
}
