@extends('adminlte::page')

{{-- Judul halaman pada browser. --}}
@section('title', 'Tambah Dokumen Pegawai')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Tambah Dokumen Pegawai</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Form Create mengirim data ke method store(). --}}
            <form action="{{ route('pegawais.dokumen.store', $pegawai) }}" method="POST">

                {{-- Token CSRF untuk keamanan form Laravel. --}}
                @csrf

                {{-- Field form digunakan bersama oleh Create dan Edit. --}}
                @include('pegawais.dokumen.form')

            </form>

        </div>

    </div>

@stop
