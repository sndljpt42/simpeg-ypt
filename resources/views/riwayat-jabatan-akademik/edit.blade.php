@extends('adminlte::page')

{{-- Judul halaman pada browser. --}}
@section('title', 'Edit Riwayat Jabatan Akademik')

{{-- Judul halaman. --}}
@section('content_header')
    <h1>Edit Riwayat Jabatan Akademik</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Form Edit mengirim data ke method update(). --}}
            <form
                action="{{ route('pegawais.riwayat-jabatan-akademik.update', [$pegawai, $riwayatJabatanAkademik]) }}"
                method="POST">

                {{-- Token CSRF. --}}
                @csrf

                {{-- Mengubah method POST menjadi PUT. --}}
                @method('PUT')

                {{-- Menggunakan form yang sama dengan halaman Create. --}}
                @include('riwayat-jabatan-akademik.form')

            </form>

        </div>

    </div>

@stop
