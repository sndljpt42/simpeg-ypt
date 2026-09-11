@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Detail Jabatan Akademik')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Detail Jabatan Akademik</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        {{-- Header card. --}}
        <div class="card-header">
            <h3 class="card-title">
                Informasi Jabatan Akademik
            </h3>
        </div>

        <div class="card-body">

            {{-- Menampilkan nama Jabatan Akademik. --}}
            <div class="form-group">
                <label>Nama Jabatan Akademik</label>
                <input type="text" class="form-control" value="{{ $jabatanAkademik->nama }}" readonly>
            </div>

            {{-- Menampilkan Golongan Minimal melalui relasi. --}}
            <div class="form-group">
                <label>Golongan Minimal</label>
                <input type="text" class="form-control" value="{{ $jabatanAkademik->golonganMin?->kode }}" readonly>
            </div>

            {{-- Menampilkan Golongan Maksimal melalui relasi. --}}
            <div class="form-group">
                <label>Golongan Maksimal</label>
                <input type="text" class="form-control" value="{{ $jabatanAkademik->golonganMax?->kode }}" readonly>
            </div>

            {{-- Menampilkan usia pensiun. --}}
            <div class="form-group">
                <label>Usia Pensiun</label>
                <div class="input-group">
                    <input type="text" class="form-control" value="{{ $jabatanAkademik->usia_pensiun }}" readonly>

                    <div class="input-group-append">
                        <span class="input-group-text">tahun</span>
                    </div>
                </div>
            </div>

            {{-- Menampilkan batas maksimal KGB setelah mentok. --}}
            <div class="form-group">
                <label>Maks. KGB Setelah Mentok</label>
                <input type="text" class="form-control" value="{{ $jabatanAkademik->maks_kgb_setelah_mentok ?? '-' }}"
                    readonly>
            </div>

            {{-- Kembali ke halaman daftar Jabatan Akademik. --}}
            <a href="{{ route('jabatan-akademik.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

            {{-- Menuju halaman Edit Jabatan Akademik. --}}
            <a href="{{ route('jabatan-akademik.edit', $jabatanAkademik) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i>
                Edit
            </a>

        </div>
    </div>

@stop
