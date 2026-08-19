@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Edit Unit Kerja')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Edit Unit Kerja</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Form Edit mengirim data ke method update(). --}}
            <form action="{{ route('unit-kerja.update', $unitKerja) }}" method="POST">

                {{-- Token CSRF untuk keamanan form Laravel. --}}
                @csrf

                {{-- Mengubah method POST menjadi PUT sesuai route update Laravel. --}}
                @method('PUT')

                {{-- Menggunakan form yang sama dengan halaman Create. --}}
                @include('unit-kerja.form')

            </form>

        </div>

    </div>

@stop
