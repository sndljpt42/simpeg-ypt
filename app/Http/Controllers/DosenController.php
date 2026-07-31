<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Pegawai;
use App\Models\JenisPegawai;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Services\PegawaiFormService;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //mengambil data dosen dan relasinya
        //earger loading digunakan untuk menghindaarin N+1 problem
        $dosens = Pegawai::with([
            'agama',
            'pendidikan',
            'unitKerja',
            'golongan',
            'jabatanAkademik',
            'statusPegawai',
            'jenisPegawai',
        ])
            ->dosen()
            ->orderBy('nama')
            ->get();

        //mengirim data dosen kehalaman index dosen

        return view('dosen.index', compact('dosens'));
    }

    private PegawaiFormService $pegawaiFormService;

    public function __construct(PegawaiFormService $pegawaiFormService)
    {
        $this->pegawaiFormService = $pegawaiFormService;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //mengambil ID jenis pegawai "Dosen"
        //nanri digunakan sebagai hidden input
        //agar pengguna tidak perlu memilih jenis pegawai secara manual

        $jenisPegawais = JenisPegawai::where('nama', JenisPegawai::DOSEN)->first();

        return view('dosen.create', array_merge(
            $this->pegawaiFormService->getMasterData(),
            [
                'jenisPegawais' => $jenisPegawais,
            ]
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePegawaiRequest $request)
    {
        //seluruh data sdudah divalidai oleh StorePegawaiRequest
        //validate hanya mengembalikan data yang lolos validasi, sehingga aman untuk langsung disimpan ke database
        $data = $request->validated();

        // menyimpan ke tabel pegawai
        Pegawai::create($data);

        return redirect()
            ->route('dosen.index')
            ->with('success', 'Data Dosen Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $dosen): View
    {
        //Supaya nanti tidak terjadi N+1 Query
        //Dengan load(), semua relasi diambil di awal sehingga halaman lebih efisien.
        $dosen->load([
            'agama',
            'pendidikan',
            'unitKerja',
            'statusPegawai',
            'golongan',
            'jabatanAkademik',
            'jenisPegawai'
        ]);

        return view('dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $dosen): View
    {
        $jenisPegawais = JenisPegawai::where('nama', JenisPegawai::DOSEN)->first();

        return view('dosen.edit', array_merge(
            $this->pegawaiFormService->getMasterData(),
            [
                'dosen' => $dosen,
                'jenisPegawais' => $jenisPegawais,
            ]
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePegawaiRequest $request, Pegawai $dosen)
    {
        //mengambil hanya data yang lolos validasi

        $data = $request->validated();

        //memperbaharui dosen
        $dosen->update($data);

        //kembali ke halaman daftar dosen
        return redirect()
            ->route('dosen.index')
            ->with('success', 'Data dosen berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $dosen)
    {
        $dosen->delete();

        return redirect()
            ->route('dosen.index')
            ->with('success', 'Data dosen berhasil dihapus');
    }

    public function trash(): View
    {   //Mengambil hanya data yang sudah di-soft delete.
        $dosens = Pegawai::with([
            'pendidikan',
            'golongan',
            'jabatanAkademik',
            'unitKerja'
        ])
            ->onlyTrashed()
            ->dosen()
            ->orderBy('nama')
            ->get();

        return view('dosen.trash', compact('dosens'));
    }

    public function restore($id)
    {
        $dosen = Pegawai::onlyTrashed()->findOrFail($id);

        $dosen->restore();

        return redirect()
            ->route('dosen.trash')
            ->with('success', 'Data dosen berhasil dipulihkan.');
    }
}
