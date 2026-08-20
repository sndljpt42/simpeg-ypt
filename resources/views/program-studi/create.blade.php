@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Tambah Program Studi')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Tambah Program Studi</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Form Create mengirim data ke method store(). --}}
            <form action="{{ route('program-studi.store') }}" method="POST">

                {{-- Token CSRF untuk keamanan form Laravel. --}}
                @csrf

                {{-- Menggunakan form yang nantinya juga dipakai oleh Edit. --}}
                @include('program-studi.form')

            </form>

        </div>

    </div>

@stop