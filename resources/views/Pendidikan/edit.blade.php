@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Edit Pendidikan')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Edit Pendidikan</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Form Edit mengirim data ke method update(). --}}
            <form action="{{ route('pendidikan.update', $pendidikan) }}" method="POST">

                {{-- Token CSRF untuk keamanan form Laravel. --}}
                @csrf

                {{-- Mengubah request POST menjadi PUT. --}}
                @method('PUT')

                {{-- Menggunakan form yang sama dengan Create. --}}
                @include('pendidikan.form')

            </form>

        </div>

    </div>

@stop
