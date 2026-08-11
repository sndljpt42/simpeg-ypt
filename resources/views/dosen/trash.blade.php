@extends('adminlte::page')

@section('title', 'Data Dosen Terhapus')

@section('content_header')
    <h1>Data Dosen Terhapus</h1>
@stop

@section('content')
    <a href="{{ route('dosen.index') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Data Dosen
    </a>
    <div class="card">
        <div class="card-body">

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

                                <form action="{{ route('dosen.restore', $dosen->id) }}" method="POST"
                                    style="display:inline" onsubmit="return confirm('Yakin ingin memulihkan data ini?')">

                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-trash-restore"></i>
                                        Restore
                                    </button>

                                </form>

                                @can('forceDelete', $dosen)
                                    <form action="{{ route('dosen.forceDelete', $dosen->id) }}" method="POST"
                                        style="display:inline"
                                        onsubmit="return confirm('PERINGATAN !!! Data ini akan dihapus permanen, apakah anda yakin ingin menghapus data ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                            Hapus Permanen
                                        </button>

                                    </form>
                                @endcan

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

@section('plugins.Datatables', true)
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
                        extend: 'copyHtml5',

                        text: '<i class="fas fa-copy"></i> Copy',

                        className: 'btn btn-secondary btn-sm',

                        title: 'Laporan Data Dosen',

                        exportOptions: {

                            columns: [0, 1, 2, 3, 4, 5, 6],

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

                        title: 'Laporan Data Dosen',

                        filename: 'Data_Dosen',

                        exportOptions: {

                            columns: [0, 1, 2, 3, 4, 5, 6],

                            format: {

                                body: function(data, row, column, node) {

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

                        title: 'Laporan Data Dosen',

                        filename: 'Data_Dosen',

                        orientation: 'landscape',

                        pageSize: 'A4',

                        exportOptions: {

                            columns: [0, 1, 2, 3, 4, 5, 6],

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

                        title: 'Laporan Data Dosen',

                        exportOptions: {

                            columns: [0, 1, 2, 3, 4, 5, 6],

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
