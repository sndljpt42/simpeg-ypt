@extends('adminlte::page')

@section('title', 'Detail Dosen')

@section('content_header')
    <h1>Detail Dosen</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Profil Dosen
            </h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="250">Nama</th>
                    <td>{{ $dosen->nama }}</td>
                </tr>

                <tr>
                    <th>NIPY</th>
                    <td>{{ $dosen->nipy }}</td>
                </tr>

                <tr>
                    <th>NIDN</th>
                    <td>{{ $dosen->nidn ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Jenis Kelamin</th>
                    <td>
                        {{ $dosen->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </td>
                </tr>

                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td>
                        {{ $dosen->tempat_lahir }},
                        {{ \Carbon\Carbon::parse($dosen->tanggal_lahir)->translatedFormat('d F Y') }}
                    </td>
                </tr>

                <tr>
                    <th>Agama</th>
                    <td>{{ $dosen->agama->nama }}</td>
                </tr>

                <tr>
                    <th>Pendidikan</th>
                    <td>{{ $dosen->pendidikan->nama }}</td>
                </tr>

                <tr>
                    <th>Unit Kerja</th>
                    <td>{{ $dosen->unitKerja->nama }}</td>
                </tr>

                <tr>
                    <th>Status Pegawai</th>
                    <td>{{ $dosen->statusPegawai->nama }}</td>
                </tr>

                <tr>
                    <th>Golongan</th>
                    <td>{{ $dosen->golongan->kode ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Jabatan Akademik</th>
                    <td>{{ $dosen->jabatanAkademik->nama ?? '-' }}</td>
                </tr>

                <tr>
                    <th>TMT</th>
                    <td>
                        {{ \Carbon\Carbon::parse($dosen->tmt)->translatedFormat('d F Y') }}
                    </td>
                </tr>

            </table>

        </div>

        <div class="card-footer">

            <a href="{{ route('dosen.index') }}" class="btn btn-secondary">
                Kembali
            </a>

            <a href="{{ route('dosen.edit', $dosen) }}" class="btn btn-warning">
                Edit
            </a>

        </div>

    </div>

@stop
