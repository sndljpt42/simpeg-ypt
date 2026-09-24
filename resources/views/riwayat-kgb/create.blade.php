@extends('adminlte::page')

{{-- Judul halaman pada browser. --}}
@section('title', 'Tambah Riwayat KGB')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Tambah Riwayat KGB</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Form Create mengirim data ke method store(). --}}
            <form action="{{ route('pegawais.riwayat-kgb.store', $pegawai) }}" method="POST">

                {{-- Token CSRF untuk keamanan form Laravel. --}}
                @csrf

                {{-- Field form digunakan bersama oleh Create dan Edit. --}}
                @include('riwayat-kgb.form')

            </form>

        </div>

    </div>

@stop
