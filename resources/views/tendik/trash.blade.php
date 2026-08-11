@extends('adminlte::page')

@section('title', 'Data Tendik Terhapus')

@section('content_header')
    <h1>Data Tendik Terhapus</h1>
@stop

@section('content')

    {{-- Kembali ke daftar Tendik --}}
    <a href="{{ route('tendik.index') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Data Tendik
    </a>

    <div class="card">
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}

                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                        <th width="180" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($tendiks as $tendik)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $tendik->nipy }}</td>

                            <td>{{ $tendik->nama }}</td>

                            <td>{{ $tendik->pendidikan?->nama }}</td>

                            <td>{{ $tendik->golongan?->kode }}</td>

                            <td>{{ $tendik->unitKerja?->nama }}</td>

                            <td class="text-center">

                                {{-- Tombol Restore --}}
                                <form action="{{ route('tendik.restore', $tendik->id) }}" method="POST"
                                    style="display:inline" onsubmit="return confirm('Yakin ingin memulihkan data ini?')">

                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-success btn-sm" title="Restore">
                                        <i class="fas fa-trash-restore"></i>
                                        Restore
                                    </button>

                                </form>
                                @can('forceDelete', $tendik)
                                    {{-- Tombol Hapus Permanen --}}
                                    <form action="{{ route('tendik.forceDelete', $tendik->id) }}" method="POST"
                                        style="display:inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini secara permanen? Data tidak dapat dipulihkan kembali.')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Permanen">
                                            <i class="fas fa-trash-alt"></i>
                                            Hapus Permanen
                                        </button>

                                    </form>
                                @endcan
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center">
                                Belum ada data Tendik yang dihapus.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

@stop
