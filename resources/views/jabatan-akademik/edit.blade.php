@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Edit Jabatan Akademik')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Edit Jabatan Akademik</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">
        <div class="card-body">

            {{-- Form Edit mengirim data ke method update(). --}}
            <form action="{{ route('jabatan-akademik.update', $jabatanAkademik) }}" method="POST">

                {{-- Token CSRF untuk keamanan form Laravel. --}}
                @csrf

                {{-- Mengubah request POST menjadi PUT. --}}
                @method('PUT')

                {{-- Menggunakan form yang sama dengan Create. --}}
                @include('jabatan-akademik.form')

            </form>

        </div>
    </div>

@stop
