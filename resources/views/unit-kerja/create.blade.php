@extends('adminlte::page')

{{-- Menentukan judul halaman browser. --}}
@section('title', 'Tambah Unit Kerja')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Tambah Unit Kerja</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Form Create Unit Kerja dikirim ke method store(). --}}
            <form action="{{ route('unit-kerja.store') }}" method="POST">

                {{-- Token CSRF untuk keamanan form Laravel. --}}
                @csrf

                {{-- Menggunakan field form yang juga akan digunakan oleh Edit. --}}
                @include('unit-kerja.form')

            </form>

        </div>

    </div>

@stop
