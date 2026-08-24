@extends('adminlte::page')

@section('title', 'Detail Jenis Pegawai')

@section('content_header')
    <h1>Detail Jenis Pegawai</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Informasi Jenis Pegawai
            </h3>
        </div>

        <div class="card-body">

            {{-- Menampilkan nama Jenis Pegawai. --}}
            <div class="form-group">

                <label for="nama">
                    Nama Jenis Pegawai
                </label>

                <input type="text" id="nama" class="form-control" value="{{ $jenisPegawai->nama }}" readonly>

            </div>

            {{-- Tombol kembali ke Index. --}}
            <a href="{{ route('jenis-pegawai.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

            {{-- Tombol Edit. --}}
            <a href="{{ route('jenis-pegawai.edit', $jenisPegawai) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i>
                Edit
            </a>

        </div>

    </div>

@stop
