@extends('adminlte::page')

@section('title', 'Edit Tenaga Kependidikan')

@section('content_header')
<h1>Edit Tenaga Kependidikan</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('tendik.update', $tendik) }}" method="POST">

            @csrf
            @method('PUT')

            @include('tendik.form', [
                'pegawai' => $tendik
            ])

        </form>

    </div>

</div>

@stop