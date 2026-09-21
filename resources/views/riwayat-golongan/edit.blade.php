@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Edit Riwayat Golongan')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Edit Riwayat Golongan</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Form Edit mengirim data ke method update(). --}}
            <form
                action="{{ route('pegawais.riwayat-golongan.update', [$pegawai, $riwayatGolongan]) }}"
                method="POST"
            >

                {{-- Token CSRF untuk keamanan form Laravel. --}}
                @csrf

                {{-- Method PUT digunakan untuk proses update. --}}
                @method('PUT')

                {{-- Field form digunakan bersama Create dan Edit. --}}
                @include('riwayat-golongan.form')

            </form>

        </div>

    </div>

@stop