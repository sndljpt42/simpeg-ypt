@extends('adminlte::page')

@section('title', 'Edit Golongan')

@section('content_header')
    <h1>Edit Golongan</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-body">

            <form action="{{ route('golongan.update', $golongan) }}" method="POST">

                @csrf

                @method('PUT')

                {{-- Menggunakan form yang sama dengan Create. --}}
                @include('golongan.form')

            </form>

        </div>

    </div>

@stop
