@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Edit Agama')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Edit Agama</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Form Edit mengirim data ke method update(). --}}
            <form action="{{ route('agama.update', $agama) }}" method="POST">

                {{-- Token CSRF untuk keamanan form Laravel. --}}
                @csrf

                {{-- Mengubah request POST menjadi PUT. --}}
                @method('PUT')

                {{-- Menggunakan form yang sama dengan Create. --}}
                @include('agama.form')

            </form>

        </div>

    </div>

@stop
