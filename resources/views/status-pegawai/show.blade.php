@extends('adminlte::page')

@section('title', 'Detail Status Pegawai')

@section('content_header')
    <h1>Detail Status Pegawai</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Informasi Status Pegawai
            </h3>
        </div>

        <div class="card-body">

            <div class="form-group">

                <label for="nama">
                    Nama Status Pegawai
                </label>

                <input type="text" id="nama" class="form-control" value="{{ $statusPegawai->nama }}" readonly>

            </div>

            {{-- Tombol kembali ke Index --}}
            <a href="{{ route('status-pegawai.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

            {{-- Tombol Edit --}}
            <a href="{{ route('status-pegawai.edit', $statusPegawai) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i>
                Edit
            </a>

        </div>

    </div>

@stop
