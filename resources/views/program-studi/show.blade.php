@extends('adminlte::page')

{{-- Menentukan judul halaman. --}}
@section('title', 'Detail Program Studi')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Detail Program Studi</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Informasi Program Studi
            </h3>
        </div>

        <div class="card-body">

            {{-- Menampilkan nama Program Studi. --}}
            <div class="form-group">

                <label>
                    Program Studi
                </label>

                <input type="text" class="form-control" value="{{ $programStudi->nama }}" readonly>

            </div>

            {{-- Menampilkan Unit Kerja melalui relasi. --}}
            <div class="form-group">

                <label>
                    Unit Kerja
                </label>

                <input type="text" class="form-control" value="{{ $programStudi->unitKerja?->nama }}" readonly>

            </div>

            {{-- Tombol kembali ke Index. --}}
            <a href="{{ route('program-studi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

            {{-- Tombol menuju halaman Edit. --}}
            <a href="{{ route('program-studi.edit', $programStudi) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i>
                Edit
            </a>

        </div>

    </div>

@stop
