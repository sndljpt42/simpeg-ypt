@extends('adminlte::page')

{{-- Judul halaman pada browser. --}}
@section('title', 'Edit Riwayat KGB')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Edit Riwayat KGB</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Form Edit mengirim perubahan data ke method update(). --}}
            <form
                action="{{ route('pegawais.riwayat-kgb.update', [
                    'pegawai' => $pegawai,
                    'riwayat_kgb' => $riwayatKGB,
                ]) }}"
                method="POST">

                {{-- Token CSRF untuk keamanan form Laravel. --}}
                @csrf

                {{-- Mengubah method POST menjadi PUT untuk route update. --}}
                @method('PUT')

                {{-- Field form digunakan bersama oleh Create dan Edit. --}}
                @include('riwayat-kgb.form')

            </form>

        </div>

    </div>

@stop
