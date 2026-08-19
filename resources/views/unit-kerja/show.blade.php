@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Detail Unit Kerja')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Detail Unit Kerja</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        {{-- Header card --}}
        <div class="card-header">
            <h3 class="card-title">
                Informasi Unit Kerja
            </h3>
        </div>

        <div class="card-body">

            {{-- Menampilkan nama Unit Kerja. --}}
            <div class="form-group">

                <label>Nama Unit Kerja</label>

                <input type="text" class="form-control" value="{{ $unitKerja->nama }}" readonly>

            </div>

            {{-- Daftar Program Studi yang berada di Unit Kerja ini. --}}
            <div class="form-group">

                <label>Program Studi</label>

                @if ($unitKerja->programStudis->count())

                    <ul class="list-group">

                        {{-- Menampilkan setiap Program Studi. --}}
                        @foreach ($unitKerja->programStudis as $programStudi)
                            <li class="list-group-item">
                                {{ $programStudi->nama }}
                            </li>
                        @endforeach

                    </ul>
                @else
                    {{-- Ditampilkan jika Unit Kerja belum memiliki Program Studi. --}}
                    <div class="alert alert-info">
                        Unit Kerja ini belum memiliki Program Studi.
                    </div>

                @endif

            </div>

            {{-- Kembali ke halaman daftar Unit Kerja. --}}
            <a href="{{ route('unit-kerja.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

            {{-- Menuju halaman Edit Unit Kerja. --}}
            <a href="{{ route('unit-kerja.edit', $unitKerja) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i>
                Edit
            </a>

        </div>

    </div>

@stop
