@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Data Pendidikan')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Data Pendidikan</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Tombol untuk membuka form tambah Pendidikan. --}}
            <a href="{{ route('pendidikan.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i>
                Tambah Pendidikan
            </a>

            {{-- Menampilkan flash message berhasil. --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">

                    {{-- Menampilkan pesan keberhasilan dari Controller. --}}
                    {{ session('success') }}

                    {{-- Tombol untuk menutup alert. --}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <i class="fas fa-check-circle mr-2"></i>

                </div>
            @endif

            {{-- Menampilkan flash message error. --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">

                    {{-- Menampilkan pesan error dari Controller. --}}
                    {{ session('error') }}

                    {{-- Tombol untuk menutup alert. --}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <i class="fas fa-exclamation-circle mr-2"></i>

                </div>
            @endif

            {{-- Tabel Pendidikan yang akan diproses oleh DataTables. --}}
            <table id="table-pendidikan" class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th width="60">No</th>

                        <th>Nama Pendidikan</th>

                        <th width="140" class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    {{-- Menampilkan seluruh data Pendidikan. --}}
                    @forelse($pendidikans as $pendidikan)
                        <tr>

                            {{-- Nomor urut akan diatur oleh DataTables. --}}
                            <td></td>

                            {{-- Menampilkan nama Pendidikan. --}}
                            <td>{{ $pendidikan->nama }}</td>

                            <td class="text-center">

                                {{-- Tombol Detail Pendidikan. --}}
                                <a href="{{ route('pendidikan.show', $pendidikan) }}" class="btn btn-info btn-sm"
                                    title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Tombol Edit Pendidikan. --}}
                                <a href="{{ route('pendidikan.edit', $pendidikan) }}" class="btn btn-warning btn-sm"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('pendidikan.destroy', $pendidikan) }}" method="POST"
                                    style="display:inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus Pendidikan ini?')">

                                    {{-- Token CSRF untuk keamanan request. --}}
                                    @csrf

                                    {{-- Mengubah request POST menjadi DELETE. --}}
                                    @method('DELETE')

                                    {{-- Tombol untuk menghapus Pendidikan. --}}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        {{-- Ditampilkan jika belum ada data Pendidikan. --}}
                        <tr>

                            <td colspan="3" class="text-center">
                                Belum ada data Pendidikan.
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

            // Menginisialisasi DataTables pada tabel Pendidikan.
            let table = $('#table-pendidikan').DataTable({

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

                        title: 'Laporan Data Pendidikan',

                        exportOptions: {

                            // Hanya mengekspor kolom No dan Nama Pendidikan.
                            columns: [0, 1],

                            format: {

                                // Menghasilkan nomor urut pada hasil export.
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

                        title: 'Laporan Data Pendidikan',

                        filename: 'Data_Pendidikan',

                        exportOptions: {

                            columns: [0, 1],

                            format: {

                                // Menghasilkan nomor urut pada hasil Excel.
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

                        title: 'Laporan Data Pendidikan',

                        filename: 'Data_Pendidikan',

                        // Menggunakan orientasi landscape.
                        orientation: 'landscape',

                        // Menggunakan ukuran kertas A4.
                        pageSize: 'A4',

                        exportOptions: {

                            columns: [0, 1],

                            format: {

                                // Menghasilkan nomor urut pada hasil PDF.
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

                        title: 'Laporan Data Pendidikan',

                        exportOptions: {

                            columns: [0, 1],

                            format: {

                                // Menghasilkan nomor urut pada hasil cetak.
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

                // Menggunakan bahasa Indonesia pada DataTables.
                language: {

                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'

                },

                // Menonaktifkan smart search.
                search: {
                    smart: false
                }

            });

            // Mengatur nomor urut agar mengikuti pencarian dan sorting.
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
