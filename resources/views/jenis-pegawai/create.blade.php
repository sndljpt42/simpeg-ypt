@extends('adminlte::page')

@section('title', 'Tambah Jenis Pegawai')

@section('conten_header')
    <h1> Tambah Jenis Pegawai </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('jenis-pegawai.store') }}" method="POST">
                @csrf
                @include('jenis-pegawai.form')
            </form>
        </div>
    </div>
@stop
