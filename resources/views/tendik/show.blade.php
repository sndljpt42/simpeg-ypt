@extends('adminlte::page')

@section('title', 'Detail tendik')

@section('content_header')
    <h1>Detail Tendik</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Profil Tendik
            </h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th colspan="2" style="text-align: center">DATA DIRI</th>
                </tr>

                <tr>
                    <th width="250">Nama</th>
                    <td>{{ $tendik->nama }}</td>
                </tr>

                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td>
                        {{ $tendik->tempat_lahir }},
                        {{ \Carbon\Carbon::parse($tendik->tanggal_lahir)->translatedFormat('d F Y') }}
                    </td>
                </tr>

                <tr>
                    <th>Jenis Kelamin</th>
                    <td>
                        {{ $tendik->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </td>
                </tr>

                <tr>
                    <th>Agama</th>
                    <td>{{ $tendik->agama->nama }}</td>
                </tr>

                <tr>
                    <th colspan="2" style="text-align: center">DATA KEPEGAWAIAN</th>
                </tr>

                <tr>
                    <th>NIPY</th>
                    <td>{{ $tendik->nipy }}</td>
                </tr>

                <tr>
                    <th>Jenis Tendik</th>
                    <td>{{ $tendik->jenis_tendik}}</td>
                </tr>

                <tr>
                    <th>Status Pegawai</th>
                    <td>{{ $tendik->statusPegawai->nama }}</td>
                </tr>

                <tr>
                    <th>Unit Kerja</th>
                    <td>{{ $tendik->unitKerja->nama }}</td>
                </tr>

                <tr>
                    <th>TMT</th>
                    <td>
                        {{ \Carbon\Carbon::parse($tendik->tmt)->translatedFormat('d F Y') }}
                    </td>
                </tr>

                <tr>
                    <th colspan="2" style="text-align: center">DATA AKADEMIK</th>
                </tr>
                <tr>
                    <th>Pendidikan</th>
                    <td>{{ $tendik->pendidikan->nama }}</td>
                </tr>

                <tr>
                    <th>Golongan</th>
                    <td>{{ $tendik->golongan->kode ?? '-' }}</td>
                </tr>

            </table>

        </div>

        <div class="card-footer">

            <a href="{{ route('tendik.index') }}" class="btn btn-secondary">
                Kembali
            </a>

            <a href="{{ route('tendik.edit', $tendik) }}" class="btn btn-warning">
                Edit
            </a>

        </div>

    </div>

@stop
