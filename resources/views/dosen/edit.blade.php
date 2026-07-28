@extends('adminlte::page')

@section('title', 'Edit Dosen')

@section('content_header')
    <h1>Edit Dosen</h1>
@stop

@section('content')

<form
    action="{{ route('dosen.update', $dosen) }}"
    method="POST">

    @csrf
    @method('PUT')

    @include('dosen.form', [
        'pegawai' => $dosen
    ])

</form>

@stop