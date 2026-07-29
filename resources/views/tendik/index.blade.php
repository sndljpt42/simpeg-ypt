@extends('adminlte::page')

@section('title', 'Data Tenaga Kependidikan')

@section('content_header')
    <h1>Data Tenaga Kependidikan</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            <a href="{{ route('tendik.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Tambah Tendik
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
                        <th>Unit Kerja</th>
                        <th width="140" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($tendiks as $tendik)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $tendik->nipy }}</td>

                            <td>{{ $tendik->nama }}</td>

                            <td>{{ $tendik->pendidikan?->nama }}</td>

                            <td>{{ $tendik->golongan?->kode }}</td>

                            <td>{{ $tendik->unitKerja?->nama }}</td>

                            <td class="text-center">

                                {{-- Tombol Detail --}}
                                <a href="{{ route('tendik.show', $tendik) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Tombol Edit --}}
                                <a href="{{ route('tendik.edit', $tendik) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('tendik.destroy', $tendik) }}" method="POST"
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

                                Belum ada data tendik.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

@stop
