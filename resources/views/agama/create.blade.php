@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Tambah Agama')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Tambah Agama</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Form Create mengirim data ke method store(). --}}
            <form action="{{ route('agama.store') }}" method="POST">

                {{-- Token CSRF untuk keamanan form Laravel. --}}
                @csrf

                {{-- Menggunakan form yang nantinya juga dipakai oleh Edit. --}}
                @include('agama.form')

            </form>

        </div>

    </div>

@stop
