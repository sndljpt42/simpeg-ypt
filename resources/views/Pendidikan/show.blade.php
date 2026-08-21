@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Detail Pendidikan')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Detail Pendidikan</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Informasi Pendidikan
            </h3>
        </div>

        <div class="card-body">

            {{-- Menampilkan nama Pendidikan. --}}
            <div class="form-group">

                <label for="nama">
                    Nama Pendidikan
                </label>

                <input type="text" id="nama" class="form-control" value="{{ $pendidikan->nama }}" readonly>

            </div>

            {{-- Tombol kembali ke halaman Index. --}}
            <a href="{{ route('pendidikan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

            {{-- Tombol menuju halaman Edit Pendidikan. --}}
            <a href="{{ route('pendidikan.edit', $pendidikan) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i>
                Edit
            </a>

        </div>

    </div>

@stop
