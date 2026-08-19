@extends('adminlte::page')

{{-- Menentukan judul halaman pada browser. --}}
@section('title', 'Data Unit Kerja')

{{-- Menampilkan judul halaman. --}}
@section('content_header')
    <h1>Data Unit Kerja</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Tombol untuk membuka form tambah Unit Kerja. --}}
            <a href="{{ route('unit-kerja.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i>
                Tambah Unit Kerja
            </a>

            {{-- Menampilkan flash message setelah proses berhasil. --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">

                    {{-- Menampilkan pesan dari Controller. --}}
                    {{ session('success') }}

                    {{-- Tombol untuk menutup alert. --}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <i class="fas fa-check-circle mr-2"></i>

                </div>
            @endif

            {{-- Menampilkan pesan error ketika proses tidak dapat dilakukan. --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">

                    {{-- Menampilkan isi flash message error dari Controller. --}}
                    {{ session('error') }}

                    {{-- Tombol untuk menutup alert. --}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                    <i class="fas fa-exclamation-circle mr-2"></i>

                </div>
            @endif

            {{-- Tabel Unit Kerja yang akan diproses oleh DataTables. --}}
            <table id="table-unit-kerja" class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th width="60">No</th>

                        <th>Nama Unit Kerja</th>

                        <th width="140" class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    {{-- Melakukan perulangan terhadap seluruh Unit Kerja. --}}
                    @forelse($unitKerjas as $unitKerja)
                        <tr>

                            {{-- Nomor akan diatur ulang oleh DataTables. --}}
                            <td></td>

                            {{-- Menampilkan nama Unit Kerja. --}}
                            <td>{{ $unitKerja->nama }}</td>

                            <td class="text-center">

                                {{-- Tombol Detail Unit Kerja. --}}
                                <a href="{{ route('unit-kerja.show', $unitKerja) }}" class="btn btn-info btn-sm"
                                    title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Tombol Edit Unit Kerja. --}}
                                <a href="{{ route('unit-kerja.edit', $unitKerja) }}" class="btn btn-warning btn-sm"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Tombol Delete Unit Kerja. --}}
                                <form action="{{ route('unit-kerja.destroy', $unitKerja) }}" method="POST"
                                    style="display:inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus Unit Kerja ini?')">

                                    {{-- Token CSRF untuk keamanan request DELETE. --}}
                                    @csrf

                                    {{-- Mengubah request POST menjadi DELETE. --}}
                                    @method('DELETE')

                                    {{-- Tombol untuk menghapus Unit Kerja. --}}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>
                            </td>

                        </tr>

                    @empty

                        {{-- Ditampilkan jika belum ada data Unit Kerja. --}}
                        <tr>

                            <td colspan="3" class="text-center">
                                Belum ada data Unit Kerja.
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

            // Menginisialisasi DataTables pada tabel Unit Kerja.
            let table = $('#table-unit-kerja').DataTable({

                // Membuat tabel responsif terhadap ukuran layar.
                responsive: true,

                // Menonaktifkan pengaturan lebar otomatis.
                autoWidth: false,

                // Menampilkan 10 data pada setiap halaman.
                pageLength: 10,

                // Memungkinkan user mengubah jumlah data per halaman.
                lengthChange: true,

                // Mengaktifkan fitur pencarian.
                searching: true,

                // Mengaktifkan pengurutan kolom.
                ordering: true,

                // Menampilkan informasi jumlah data.
                info: true,

                // Mengatur posisi tombol, search, tabel, info, dan pagination.
                dom: 'Bfrtip',

                // Menentukan tombol export yang tersedia.
                buttons: [

                    {
                        // Tombol untuk menyalin data ke clipboard.
                        extend: 'copyHtml5',

                        // Tampilan tombol Copy.
                        text: '<i class="fas fa-copy"></i> Copy',

                        // Styling tombol.
                        className: 'btn btn-secondary btn-sm',

                        // Judul hasil copy.
                        title: 'Laporan Data Unit Kerja',

                        // Hanya mengekspor kolom No dan Nama Unit Kerja.
                        exportOptions: {

                            columns: [0, 1],

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
                        // Tombol export Excel.
                        extend: 'excelHtml5',

                        // Tampilan tombol Excel.
                        text: '<i class="fas fa-file-excel"></i> Excel',

                        // Styling tombol.
                        className: 'btn btn-success btn-sm',

                        // Judul laporan Excel.
                        title: 'Laporan Data Unit Kerja',

                        // Nama file hasil export.
                        filename: 'Data_Unit_Kerja',

                        // Hanya mengekspor kolom No dan Nama Unit Kerja.
                        exportOptions: {

                            columns: [0, 1],

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
                        // Tombol export PDF.
                        extend: 'pdfHtml5',

                        // Tampilan tombol PDF.
                        text: '<i class="fas fa-file-pdf"></i> PDF',

                        // Styling tombol.
                        className: 'btn btn-danger btn-sm',

                        // Judul laporan PDF.
                        title: 'Laporan Data Unit Kerja',

                        // Nama file PDF.
                        filename: 'Data_Unit_Kerja',

                        // Menggunakan orientasi landscape seperti Data Dosen.
                        orientation: 'landscape',

                        // Menggunakan ukuran kertas A4.
                        pageSize: 'A4',

                        // Hanya mengekspor kolom No dan Nama Unit Kerja.
                        exportOptions: {

                            columns: [0, 1],

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
                        // Tombol untuk mencetak data Unit Kerja.
                        extend: 'print',

                        // Tampilan tombol Print.
                        text: '<i class="fas fa-print"></i> Print',

                        // Styling tombol.
                        className: 'btn btn-info btn-sm',

                        // Judul hasil cetak.
                        title: 'Laporan Data Unit Kerja',

                        // Hanya mencetak kolom No dan Nama Unit Kerja.
                        exportOptions: {

                            columns: [0, 1],

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

                // Menggunakan bahasa Indonesia pada DataTables.
                language: {

                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'

                },

                // Menonaktifkan smart search agar pencarian lebih konsisten.
                search: {
                    smart: false
                }

            });

            // Mengatur nomor urut agar mengikuti hasil search dan sorting.
            table.on('order.dt search.dt draw.dt', function() {

                let i = 1;

                table.column(0, {

                    search: 'applied',

                    order: 'applied'

                }).nodes().each(function(cell) {

                    // Mengisi nomor berdasarkan urutan data yang sedang ditampilkan.
                    cell.innerHTML = i++;

                });

            }).draw();

        });
    </script>
@endpush
