@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Tambah Golongan')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Tambah Golongan</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Form Create mengirim data ke method store(). --}}
            <form action="{{ route('golongan.store') }}" method="POST">

                {{-- Token CSRF untuk keamanan form Laravel. --}}
                @csrf

                {{-- Form Golongan akan diletakkan di file terpisah. --}}
                @include('golongan.form')

            </form>

        </div>

    </div>

@stop
