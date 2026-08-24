@extends('adminlte::page')

@section('title', 'Data Jenis Pegawai')

@section('content_header')
    <h1>Data Jenis Pegawai</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Tombol Tambah Jenis Pegawai --}}
            <a href="{{ route('jenis-pegawai.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i>
                Tambah Jenis Pegawai
            </a>

            {{-- Flash message berhasil --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">

                    {{ session('success') }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <i class="fas fa-check-circle mr-2"></i>

                </div>
            @endif

            {{-- Flash message error --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">

                    {{ session('error') }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <i class="fas fa-exclamation-circle mr-2"></i>

                </div>
            @endif

            <table id="table-jenis-pegawai" class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th width="60">No</th>

                        <th>Nama Jenis Pegawai</th>

                        <th width="140" class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($jenisPegawais as $jenisPegawai)
                        <tr>

                            {{-- Nomor urut diatur DataTables --}}
                            <td></td>

                            <td>
                                {{ $jenisPegawai->nama }}
                            </td>

                            <td class="text-center">

                                {{-- Detail --}}
                                <a href="{{ route('jenis-pegawai.show', $jenisPegawai) }}" class="btn btn-info btn-sm"
                                    title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('jenis-pegawai.edit', $jenisPegawai) }}" class="btn btn-warning btn-sm"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Tombol Delete Jenis Pegawai. --}}
                                <form action="{{ route('jenis-pegawai.destroy', $jenisPegawai) }}" method="POST"
                                    style="display:inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus Jenis Pegawai ini?')">

                                    {{-- Token CSRF untuk keamanan request. --}}
                                    @csrf

                                    {{-- Mengubah request POST menjadi DELETE. --}}
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3" class="text-center">
                                Belum ada data Jenis Pegawai.
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

            let table = $('#table-jenis-pegawai').DataTable({

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

                        title: 'Laporan Data Jenis Pegawai',

                        exportOptions: {

                            columns: [0, 1],

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

                        title: 'Laporan Data Jenis Pegawai',

                        filename: 'Data_Jenis_Pegawai',

                        exportOptions: {

                            columns: [0, 1],

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

                        title: 'Laporan Data Jenis Pegawai',

                        filename: 'Data_Jenis_Pegawai',

                        orientation: 'landscape',

                        pageSize: 'A4',

                        exportOptions: {

                            columns: [0, 1],

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

                        title: 'Laporan Data Jenis Pegawai',

                        exportOptions: {

                            columns: [0, 1],

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
