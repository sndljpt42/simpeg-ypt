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

            <a href="{{ route('tendik.trash') }}" class="btn btn-secondary mb-3">
                <i class="fas fa-trash-restore"></i>
                Data Terhapus
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

            <table id="table-tendik" class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th width="60">No</th>
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

                            <td></td>

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

                            <td colspan="8" class="text-center">

                                Belum ada data tendik.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

@stop
@section('plugins.Datatables', true)

@push('js')
    <script>
        $(function() {

            let table = $('#table-tendik').DataTable({

                responsive: true,

                autoWidth: false,

                pageLength: 10,

                lengthChange: true,

                searching: true,

                ordering: true,

                info: true,

                dom: 'Bfrtip',

                buttons: [

                    {
                        extend: 'copyHtml5',

                        text: '<i class="fas fa-copy"></i> Copy',

                        className: 'btn btn-secondary btn-sm',

                        title: 'Laporan Data Tenaga Kependidikan',

                        exportOptions: {

                            columns: [0, 1, 2, 3, 4, 5],

                            format: {

                                body: function(data, row, column) {

                                    if (column === 0) {
                                        return row + 1;
                                    }

                                    return data;

                                }

                            }

                        }

                    },

                    {
                        extend: 'excelHtml5',

                        text: '<i class="fas fa-file-excel"></i> Excel',

                        className: 'btn btn-success btn-sm',

                        title: 'Laporan Data Tenaga Kependidikan',

                        filename: 'Data_Tenaga_Kependidikan',

                        exportOptions: {

                            columns: [0, 1, 2, 3, 4, 5],

                            format: {

                                body: function(data, row, column) {

                                    if (column === 0) {
                                        return row + 1;
                                    }

                                    return data;

                                }

                            }

                        }

                    },

                    {
                        extend: 'pdfHtml5',

                        text: '<i class="fas fa-file-pdf"></i> PDF',

                        className: 'btn btn-danger btn-sm',

                        title: 'Laporan Data Tenaga Kependidikan',

                        filename: 'Data_Tenaga_Kependidikan',

                        orientation: 'landscape',

                        pageSize: 'A4',

                        exportOptions: {

                            columns: [0, 1, 2, 3, 4, 5],

                            format: {

                                body: function(data, row, column) {

                                    if (column === 0) {
                                        return row + 1;
                                    }

                                    return data;

                                }

                            }

                        }

                    },

                    {
                        extend: 'print',

                        text: '<i class="fas fa-print"></i> Print',

                        className: 'btn btn-info btn-sm',

                        title: 'Laporan Data Tenaga Kependidikan',

                        exportOptions: {

                            columns: [0, 1, 2, 3, 4, 5],

                            format: {

                                body: function(data, row, column) {

                                    if (column === 0) {
                                        return row + 1;
                                    }

                                    return data;

                                }

                            }

                        }

                    }

                ],

                language: {

                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'

                },
                search: {
                    smart: false
                }

            });
            //no urut selalu diperbaharui
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
