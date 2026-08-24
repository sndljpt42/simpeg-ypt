@extends('adminlte::page')

@section('title', 'Edit Jenis Pegawai')

@section('content_header')
    <h1>Edit Jenis Pegawai</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Form Edit mengirim data ke method update(). --}}
            <form action="{{ route('jenis-pegawai.update', $jenisPegawai) }}" method="POST">

                {{-- Token CSRF untuk keamanan form Laravel. --}}
                @csrf

                {{-- Mengubah request POST menjadi PUT. --}}
                @method('PUT')

                {{-- Menggunakan form yang sama dengan Create. --}}
                @include('jenis-pegawai.form')

            </form>

        </div>

    </div>

@stop
