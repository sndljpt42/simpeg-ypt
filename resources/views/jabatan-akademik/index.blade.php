@extends('adminlte::page')

@section('title', 'Jabatan Akademik')

@section('content_header')
    <h1>Jabatan Akademik</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            {{-- Tombol untuk membuka halaman tambah Jabatan Akademik. --}}
            <a href="{{ route('jabatan-akademik.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Tambah Jabatan Akademik
            </a>

            {{-- Menampilkan flash message berhasil dari Controller. --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">

                    {{-- Menampilkan isi flash message success dari Controller. --}}
                    {{ session('success') }}

                    {{-- Tombol untuk menutup alert. --}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                    <i class="fas fa-check-circle mr-2"></i>

                </div>
            @endif

            {{-- Menampilkan flash message error dari Controller. --}}
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

            {{-- Tabel Jabatan Akademik yang akan diproses oleh DataTables. --}}
            <table id="table-jabatan-akademik" class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Jabatan Akademik</th>
                        <th>Golongan Minimal</th>
                        <th>Golongan Maksimal</th>
                        <th>Usia Pensiun</th>
                        <th>Maks. KGB Setelah Mentok</th>
                        <th width="140" class="text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>

                    {{-- Melakukan perulangan terhadap seluruh Jabatan Akademik. --}}
                    @forelse($jabatanAkademiks as $jabatanAkademik)
                        <tr>

                            {{-- Nomor akan diatur oleh DataTables. --}}
                            <td></td>

                            {{-- Menampilkan nama Jabatan Akademik. --}}
                            <td>{{ $jabatanAkademik->nama }}</td>

                            {{-- Menampilkan nama Golongan Minimal melalui relasi. --}}
                            <td>{{ $jabatanAkademik->golonganMin?->kode }}</td>

                            {{-- Menampilkan nama Golongan Maksimal melalui relasi. --}}
                            <td>{{ $jabatanAkademik->golonganMax?->kode }}</td>

                            {{-- Menampilkan usia pensiun. --}}
                            <td>{{ $jabatanAkademik->usia_pensiun }} tahun</td>

                            {{-- Menampilkan batas maksimal KGB setelah mentok. --}}
                            <td>
                                {{ $jabatanAkademik->maks_kgb_setelah_mentok !== null ? $jabatanAkademik->maks_kgb_setelah_mentok : '-' }}
                            </td>

                            <td class="text-center">

                                {{-- Tombol Detail Jabatan Akademik. --}}
                                <a href="{{ route('jabatan-akademik.show', $jabatanAkademik) }}" class="btn btn-info btn-sm"
                                    title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Tombol Edit Jabatan Akademik. --}}
                                <a href="{{ route('jabatan-akademik.edit', $jabatanAkademik) }}"
                                    class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Tombol Delete Jabatan Akademik. --}}
                                <form action="{{ route('jabatan-akademik.destroy', $jabatanAkademik) }}" method="POST"
                                    style="display:inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus Jabatan Akademik ini?')">

                                    {{-- Token CSRF untuk keamanan request. --}}
                                    @csrf

                                    {{-- Mengubah request POST menjadi DELETE. --}}
                                    @method('DELETE')

                                    {{-- Tombol untuk menghapus Jabatan Akademik. --}}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        {{-- Ditampilkan jika belum ada data Jabatan Akademik. --}}
                        <tr>
                            <td colspan="7" class="text-center">
                                Belum ada data Jabatan Akademik.
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

            // Menginisialisasi DataTables pada tabel Jabatan Akademik.
            let table = $('#table-jabatan-akademik').DataTable({

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
                        title: 'Laporan Data Jabatan Akademik',

                        // Mengekspor semua kolom data kecuali Aksi.
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5],

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
                        title: 'Laporan Data Jabatan Akademik',

                        // Nama file hasil export.
                        filename: 'Data_Jabatan_Akademik',

                        // Mengekspor semua kolom data kecuali Aksi.
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5],

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
                        title: 'Laporan Data Jabatan Akademik',

                        // Nama file hasil export.
                        filename: 'Data_Jabatan_Akademik',

                        // Menggunakan orientasi landscape agar tabel lebih lebar.
                        orientation: 'landscape',

                        // Menggunakan ukuran kertas A4.
                        pageSize: 'A4',

                        // Mengekspor semua kolom data kecuali Aksi.
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5],

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
                        // Tombol untuk mencetak tabel.
                        extend: 'print',

                        // Tampilan tombol Print.
                        text: '<i class="fas fa-print"></i> Print',

                        // Styling tombol.
                        className: 'btn btn-info btn-sm',

                        // Judul laporan cetak.
                        title: 'Laporan Data Jabatan Akademik',

                        // Mengekspor semua kolom data kecuali Aksi.
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5],

                            format: {

                                // Membuat nomor urut pada hasil print.
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

                // Menonaktifkan smart search agar pencarian mengikuti teks secara lebih konsisten.
                search: {
                    smart: false
                }

            });

            // Mengatur nomor urut berdasarkan hasil sorting dan pencarian DataTables.
            table.on('order.dt search.dt draw.dt', function() {

                table
                    .column(0, {
                        search: 'applied',
                        order: 'applied'
                    })
                    .nodes()
                    .each(function(cell, i) {

                        cell.innerHTML = i + 1;

                    });

            }).draw();

        });
    </script>
@endpush
