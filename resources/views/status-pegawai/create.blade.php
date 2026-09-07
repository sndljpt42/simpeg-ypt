@extends('adminlte::page')

@section('title', 'Tambah Status Pegawai')

@section('content_header')
    <h1>Tambah Status Pegawai</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-body">

            <form action="{{ route('status-pegawai.store') }}" method="POST">

                @csrf

                @include('status-pegawai.form')

            </form>

        </div>

    </div>

@stop
