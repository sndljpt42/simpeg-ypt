@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Detail Agama')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Detail Agama</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Informasi Agama
            </h3>
        </div>

        <div class="card-body">

            {{-- Menampilkan nama Agama. --}}
            <div class="form-group">

                <label for="nama">
                    Nama Agama
                </label>

                <input type="text" id="nama" class="form-control" value="{{ $agama->nama }}" readonly>

            </div>

            {{-- Tombol kembali ke halaman Index. --}}
            <a href="{{ route('agama.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

            {{-- Tombol menuju halaman Edit. --}}
            <a href="{{ route('agama.edit', $agama) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i>
                Edit
            </a>

        </div>

    </div>

@stop
