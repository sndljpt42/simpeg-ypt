@extends('adminlte::page')

@section('title', 'Detail Golongan')

@section('content_header')
    <h1>Detail Golongan</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Informasi Golongan
            </h3>
        </div>

        <div class="card-body">

            {{-- Field Golongan --}}
            <div class="form-group">

                <label for="golongan">
                    Golongan
                </label>

                <input type="text" id="golongan" class="form-control" value="{{ $golongan->golongan }}" readonly>

            </div>

            {{-- Field Ruang --}}
            <div class="form-group">

                <label for="ruang">
                    Ruang
                </label>

                <input type="text" id="ruang" class="form-control" value="{{ $golongan->ruang }}" readonly>

            </div>

            {{-- Field Kode --}}
            <div class="form-group">

                <label for="kode">
                    Kode
                </label>

                <input type="text" id="kode" class="form-control" value="{{ $golongan->kode }}" readonly>

            </div>

            {{-- Tombol Kembali --}}
            <a href="{{ route('golongan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

            {{-- Tombol Edit --}}
            <a href="{{ route('golongan.edit', $golongan) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i>
                Edit
            </a>

        </div>

    </div>

@stop
