@extends('adminlte::page')

@section('title', 'Data Status Pegawai')

@section('content_header')
    <h1>Data Status Pegawai</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Tombol Tambah Status Pegawai --}}
            <a href="{{ route('status-pegawai.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i>
                Tambah Status Pegawai
            </a>

            {{-- Flash message berhasil --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">

                    <i class="fas fa-check-circle mr-2"></i>

                    {{ session('success') }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
            @endif

            {{-- Flash message error --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="fas fa-exclamation-circle mr-2"></i>

                    {{ session('error') }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
            @endif

            <table id="table-status-pegawai" class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th width="60">No</th>

                        <th>Nama Status Pegawai</th>

                        <th width="140" class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($statusPegawais as $statusPegawai)
                        <tr>

                            {{-- Nomor urut diatur oleh DataTables --}}
                            <td></td>

                            <td>
                                {{ $statusPegawai->nama }}
                            </td>

                            <td class="text-center">

                                {{-- Detail --}}
                                <a href="{{ route('status-pegawai.show', $statusPegawai) }}" class="btn btn-info btn-sm"
                                    title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('status-pegawai.edit', $statusPegawai) }}" class="btn btn-warning btn-sm"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('status-pegawai.destroy', $statusPegawai) }}" method="POST"
                                    style="display:inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus Status Pegawai ini?')">
                                    @csrf
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
                                Belum ada data Status Pegawai.
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

            // Menginisialisasi DataTables.
            let table = $('#table-status-pegawai').DataTable({

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
                        // Tombol Copy.
                        extend: 'copyHtml5',

                        text: '<i class="fas fa-copy"></i> Copy',

                        className: 'btn btn-secondary btn-sm',

                        title: 'Laporan Data Status Pegawai',

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
                        // Tombol Excel.
                        extend: 'excelHtml5',

                        text: '<i class="fas fa-file-excel"></i> Excel',

                        className: 'btn btn-success btn-sm',

                        title: 'Laporan Data Status Pegawai',

                        filename: 'Data_Status_Pegawai',

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
                        // Tombol PDF.
                        extend: 'pdfHtml5',

                        text: '<i class="fas fa-file-pdf"></i> PDF',

                        className: 'btn btn-danger btn-sm',

                        title: 'Laporan Data Status Pegawai',

                        filename: 'Data_Status_Pegawai',

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
                        // Tombol Print.
                        extend: 'print',

                        text: '<i class="fas fa-print"></i> Print',

                        className: 'btn btn-info btn-sm',

                        title: 'Laporan Data Status Pegawai',

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

            // Mengatur nomor urut.
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
