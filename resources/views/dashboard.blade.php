@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard SIMPEG YPT</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <x-adminlte-small-box
                title="{{$jumlahDosen}}"
                text="Jumlah Dosen"
                icon="fas fa-user-graduate"
                theme="info"
            />
        </div>

        <div class="col-md-3">
            <x-adminlte-small-box
                title="{{$jumlahTendik}}"
                text="Jumlah Tendik"
                icon="fas fa-users"
                theme="success"
            />
        </div>
    </div>
@stop