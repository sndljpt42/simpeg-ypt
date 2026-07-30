@extends('adminlte::page')

@section('title', 'Data Dosen')

@section('content_header')
    <h1>Data Dosen</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            <a href="{{ route('dosen.create') }}" class="btn btn-primary mb-3">
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

            <table id="table-dosen" class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th width="60">No</th>
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

                            <td></td>

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

                            <td colspan="8" class="text-center">

                                Belum ada data dosen.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

@stop

@section('plugins.Datatables', true);
@push('js')
    <script>
        $(function() {

            let table = $('#table-dosen').DataTable({

                responsive: true,

                autoWidth: false,

                pageLength: 10,

                lengthChange: true,

                searching: true,

                ordering: true,

                info: true,

                //B = Buttons f = Filter (Search) r = Processing t = Table i = Information p = Pagination
                dom: 'Bfrtip',

                buttons: [

                    {
                        extend: 'copy',
                        text: '<i class="fas fa-copy"></i> Copy',
                        className: 'btn btn-secondary btn-sm'
                    },

                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-success btn-sm'
                    },

                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: 'btn btn-danger btn-sm'
                    },

                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        className: 'btn btn-info btn-sm'
                    }

                ],

                language: {

                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'

                },

                search: {
                    smart: false
                }

            });

            table.on('order.dt search.dt draw.dt', function() {

                let i = 1;

                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell) {

                    cell.innerHTML = i++;

                });

            }).draw();



        });
    </script>
@endpush
