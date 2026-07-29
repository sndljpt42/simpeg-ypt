@extends('adminlte::page')

@section('title', 'Tambah Tenaga Kependidikan')

@section('content_header')
    <h1>Tambah Tenaga Kependidikan</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('tendik.store') }}" method="POST">

            @csrf

            @include('tendik.form')

        </form>

    </div>
</div>

@stop