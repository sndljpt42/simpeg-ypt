@extends('adminlte::page')

@section('title', 'Edit Status Pegawai')

@section('content_header')
    <h1>Edit Status Pegawai</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-body">

            <form action="{{ route('status-pegawai.update', $statusPegawai) }}" method="POST">

                @csrf

                @method('PUT')

                @include('status-pegawai.form')

            </form>

        </div>

    </div>

@stop
