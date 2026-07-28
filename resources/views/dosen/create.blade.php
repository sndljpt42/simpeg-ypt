@extends('adminlte::page')

@section('title', 'Tambah Dosen')

@section('content_header')
    <h1>Tambah Dosen</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('dosen.store') }}" method="POST">

            @csrf

            @include('dosen.form')

        </form>

    </div>

</div>

@stop