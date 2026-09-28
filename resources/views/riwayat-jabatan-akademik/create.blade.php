@extends('adminlte::page')

{{-- Judul halaman pada browser. --}}
@section('title', 'Tambah Riwayat Jabatan Akademik')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Tambah Riwayat Jabatan Akademik</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Form Create mengirim data ke method store(). --}}
            <form action="{{ route('pegawais.riwayat-jabatan-akademik.store', $pegawai) }}" method="POST">

                {{-- Token CSRF untuk keamanan form Laravel. --}}
                @csrf

                {{-- Field form digunakan bersama oleh Create dan Edit. --}}
                @include('riwayat-jabatan-akademik.form')

            </form>

        </div>

    </div>

@stop
