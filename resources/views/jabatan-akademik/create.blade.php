@extends('adminlte::page')

@section('title', 'Tambah Jabatan Akademik')

@section('content_header')
    <h1>Tambah Jabatan Akademik</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-body">

            <form action="{{ route('jabatan-akademik.store') }}" method="POST">

                @csrf

                {{-- Menggunakan form yang sama untuk Create dan Edit. --}}
                @include('jabatan-akademik.form')

            </form>

        </div>

    </div>

@stop
