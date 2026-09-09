@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Data Golongan')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Data Golongan</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Tombol untuk membuka form tambah Golongan. --}}
            <a href="{{ route('golongan.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i>
                Tambah Golongan
            </a>

            {{-- Menampilkan flash message berhasil. --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">

                    <i class="fas fa-check-circle mr-2"></i>

                    {{ session('success') }}

                    {{-- Tombol untuk menutup alert. --}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
            @endif

            {{-- Menampilkan flash message error. --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="fas fa-exclamation-circle mr-2"></i>

                    {{ session('error') }}

                    {{-- Tombol untuk menutup alert. --}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
            @endif

            {{-- Tabel Golongan yang akan diproses oleh DataTables. --}}
            <table id="table-golongan" class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th width="60">No</th>

                        <th>Golongan</th>

                        <th>Ruang</th>

                        <th>Kode</th>

                        <th width="140" class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    {{-- Menampilkan seluruh data Golongan. --}}
                    @forelse($golongans as $golongan)
                        <tr>

                            {{-- Nomor urut akan diatur oleh DataTables. --}}
                            <td></td>

                            {{-- Menampilkan kelompok Golongan, misalnya II, III, IV. --}}
                            <td>{{ $golongan->golongan }}</td>

                            {{-- Menampilkan Ruang, misalnya A, B, C, D, E. --}}
                            <td>{{ $golongan->ruang }}</td>

                            {{-- Menampilkan kode gabungan, misalnya III/A. --}}
                            <td>{{ $golongan->kode }}</td>

                            <td class="text-center">

                                {{-- Tombol Detail. --}}
                                <a href="{{ route('golongan.show', $golongan) }}" class="btn btn-info btn-sm"
                                    title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Tombol Edit. --}}
                                <a href="{{ route('golongan.edit', $golongan) }}" class="btn btn-warning btn-sm"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Tombol Hapus. --}}
                                <form action="{{ route('golongan.destroy', $golongan) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus Golongan {{ $golongan->kode }}?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center">
                                Belum ada data Golongan.
                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@stop

{{-- Mengaktifkan plugin DataTables AdminLTE. --}}
@section('plugins.Datatables', true)

@push('js')
    <script>
        $(function() {

            // Menginisialisasi DataTables pada tabel Golongan.
            let table = $('#table-golongan').DataTable({

                // Membuat tabel responsif.
                responsive: true,

                // Menonaktifkan pengaturan lebar otomatis.
                autoWidth: false,

                // Menampilkan 10 data per halaman.
                pageLength: 10,

                // Memungkinkan user memilih jumlah data per halaman.
                lengthChange: true,

                // Mengaktifkan pencarian.
                searching: true,

                // Mengaktifkan sorting.
                ordering: true,

                // Menampilkan informasi jumlah data.
                info: true,

                // Mengatur posisi tombol, search, tabel, dan pagination.
                dom: 'Bfrtip',

                buttons: [

                    {
                        // Tombol Copy.
                        extend: 'copyHtml5',

                        text: '<i class="fas fa-copy"></i> Copy',

                        className: 'btn btn-secondary btn-sm',

                        title: 'Laporan Data Golongan',

                        exportOptions: {

                            // Mengekspor kolom No, Golongan, Ruang, dan Kode.
                            columns: [0, 1, 2, 3],

                            format: {

                                // Membuat nomor urut pada hasil export.
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

                        title: 'Laporan Data Golongan',

                        filename: 'Data_Golongan',

                        exportOptions: {

                            columns: [0, 1, 2, 3],

                            format: {

                                // Membuat nomor urut pada hasil Excel.
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

                        title: 'Laporan Data Golongan',

                        filename: 'Data_Golongan',

                        orientation: 'landscape',

                        pageSize: 'A4',

                        exportOptions: {

                            columns: [0, 1, 2, 3],

                            format: {

                                // Membuat nomor urut pada hasil PDF.
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

                        title: 'Laporan Data Golongan',

                        exportOptions: {

                            columns: [0, 1, 2, 3],

                            format: {

                                // Membuat nomor urut pada hasil cetak.
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

                // Menggunakan bahasa Indonesia.
                language: {

                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'

                },

                // Menonaktifkan smart search.
                search: {
                    smart: false
                }

            });

            // Mengatur nomor urut agar mengikuti search dan sorting.
            table.on('order.dt search.dt draw.dt', function() {

                let i = 1;

                table.column(0, {

                    search: 'applied',

                    order: 'applied'

                }).nodes().each(function(cell) {

                    // Mengisi nomor urut berdasarkan data yang sedang ditampilkan.
                    cell.innerHTML = i++;

                });

            }).draw();

        });
    </script>
@endpush
