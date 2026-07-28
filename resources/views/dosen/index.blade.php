@extends('adminlte::page')

@section('title', 'Data Dosen')

@section('content_header')
    <h1>Data Dosen</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            <a href="#" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Tambah Dosen
            </a>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>
                    <i class="fas fa-check-circle mr-2"></i>
                </div>
            @endif

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIPY</th>
                        <th>Nama</th>
                        <th>Pendidikan</th>
                        <th>Golongan</th>
                        <th>Jabatan Akademik</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($dosens as $dosen)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $dosen->nipy }}</td>

                            <td>{{ $dosen->nama }}</td>

                            <td>{{ $dosen->pendidikan?->nama }}</td>

                            <td>{{ $dosen->golongan?->kode }}</td>

                            <td>{{ $dosen->jabatanAkademik?->nama }}</td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center">

                                Belum ada data dosen.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

@stop
