@extends('adminlte::page')

{{-- Judul halaman --}}
@section('title', 'Dokumen Pegawai')

{{-- Header halaman --}}
@section('content_header')
    <h1>Dokumen Pegawai</h1>
@stop

{{-- Isi halaman --}}
@section('content')

    {{-- Informasi Pegawai --}}
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Informasi Pegawai
            </h3>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-3">
                    <strong>Nama</strong>
                    <div>
                        {{ $pegawai->nama }}
                    </div>
                </div>

                <div class="col-md-3">
                    <strong>NIPY</strong>
                    <div>
                        {{ $pegawai->nipy ?? '-' }}
                    </div>
                </div>

                <div class="col-md-3">
                    <strong>Jenis Pegawai</strong>
                    <div>
                        {{ $pegawai->jenisPegawai?->nama ?? '-' }}
                    </div>
                </div>

                <div class="col-md-3">
                    <strong>Unit Kerja</strong>
                    <div>
                        {{ $pegawai->unitKerja?->nama ?? '-' }}
                    </div>  
                </div>

            </div>

        </div>

    </div>


    {{-- Repository Dokumen --}}
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-folder-open mr-1"></i>
                Repository Dokumen
            </h3>
        </div>

        <div class="card-body">

            {{-- Pesan jika belum ada dokumen --}}
            @if ($dokumens->isEmpty())

                <div class="alert alert-info">

                    <i class="fas fa-info-circle mr-1"></i>

                    Pegawai ini belum memiliki dokumen.

                </div>
            @else
                <div class="table-responsive">

                    <table id="table-dokumen" class="table table-bordered table-striped">

                        <thead>

                            <tr>

                                <th width="60">
                                    No
                                </th>

                                <th>
                                    Nama Dokumen
                                </th>

                                <th>
                                    Deskripsi
                                </th>

                                <th width="120">
                                    Jumlah Versi
                                </th>

                                <th width="120">
                                    Dibuat
                                </th>

                                <th width="120" class="text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($dokumens as $dokumen)
                                <tr>

                                    {{-- Nomor diatur oleh DataTables --}}
                                    <td></td>

                                    <td>
                                        {{ $dokumen->nama }}
                                    </td>

                                    <td>
                                        {{ $dokumen->deskripsi ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $dokumen->versions->count() }}
                                        versi
                                    </td>

                                    <td>
                                        {{ $dokumen->created_at?->format('d-m-Y') ?? '-' }}
                                    </td>

                                    <td class="text-center">

                                        {{-- Belum ada action pada tahap ini --}}
                                        <span class="text-muted">
                                            -
                                        </span>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

        <div class="card-footer">

            <a href="{{ url()->previous() }}" class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>
                Kembali

            </a>

        </div>

    </div>

@stop


{{-- Mengaktifkan plugin DataTables AdminLTE --}}
@section('plugins.Datatables', true)

@push('js')
    <script>
        $(function() {

            let table = $('#table-dokumen').DataTable({

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

                        title: 'Repository Dokumen Pegawai',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },

                    {
                        extend: 'excelHtml5',

                        text: '<i class="fas fa-file-excel"></i> Excel',

                        className: 'btn btn-success btn-sm',

                        title: 'Repository Dokumen Pegawai',

                        filename: 'Repository_Dokumen_Pegawai',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },

                    {
                        extend: 'pdfHtml5',

                        text: '<i class="fas fa-file-pdf"></i> PDF',

                        className: 'btn btn-danger btn-sm',

                        title: 'Repository Dokumen Pegawai',

                        filename: 'Repository_Dokumen_Pegawai',

                        orientation: 'landscape',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },

                    {
                        extend: 'print',

                        text: '<i class="fas fa-print"></i> Print',

                        className: 'btn btn-info btn-sm',

                        title: 'Repository Dokumen Pegawai',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
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


            // Mengatur nomor urut DataTables.
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
