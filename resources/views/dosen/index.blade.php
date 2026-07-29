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
                        <th>JAD</th>
                        <th>Unit Kerja</th>
                        <th width="140" class="text-center">Aksi</th>
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

                            <td>{{ $dosen->unitKerja?->nama }}</td>

                            <td class="text-center">

                                {{-- Tombol Detail --}}
                                <a href="{{ route('dosen.show', $dosen) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Tombol Edit --}}
                                <a href="{{ route('dosen.edit', $dosen) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('dosen.destroy', $dosen) }}" method="POST"
                                    style="display:inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                            </td>
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
