@extends('adminlte::page')

{{-- Judul halaman pada browser. --}}
@section('title', 'Riwayat KGB Pegawai')

{{-- Judul halaman. --}}
@section('content_header')
    <h1>Riwayat KGB</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Informasi singkat pegawai yang sedang dilihat riwayatnya. --}}
            <div class="card bg-light border mb-3">

                <div class="card-body py-3">

                    <div class="row align-items-center">

                        {{-- Identitas utama pegawai. --}}
                        <div class="col-md-5">

                            <div class="d-flex align-items-center">

                                {{-- Ikon identitas pegawai. --}}
                                <div class="mr-3">
                                    <span class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 48px; height: 48px;">
                                        <i class="fas fa-user text-white"></i>
                                    </span>
                                </div>

                                <div>

                                    {{-- Nama pegawai. --}}
                                    <h5 class="mb-1 font-weight-bold">
                                        {{ $pegawai->nama }}
                                    </h5>

                                    {{-- NIPY pegawai. --}}
                                    <div class="text-muted">
                                        <i class="fas fa-id-card mr-1"></i>
                                        NIPY: {{ $pegawai->nipy }}
                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- Penanda konteks halaman. --}}
                        <div class="col-md-4 mt-3 mt-md-0">

                            <div class="border-left pl-3">

                                <div class="text-muted small">
                                    RIWAYAT
                                </div>

                                <div class="font-weight-bold mt-1">
                                    <i class="fas fa-history text-info mr-1"></i>
                                    KGB
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Kembali ke halaman sebelumnya. --}}
            <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

            {{-- Tombol untuk menambah riwayat KGB. --}}
            <a href="{{ route('pegawais.riwayat-kgb.create', $pegawai) }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i>
                Tambah Riwayat KGB
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

            {{-- Tabel riwayat KGB. --}}
            <table id="table-riwayat-kgb" class="table table-bordered table-striped">

                <thead>
                    <tr>

                        <th width="60">No</th>

                        <th>Nomor SK</th>

                        <th>Tanggal SK</th>

                        <th>TMT</th>

                        <th>Keterangan</th>

                        <th width="140" class="text-center">
                            Aksi
                        </th>

                    </tr>
                </thead>

                <tbody>

                    {{-- Menampilkan seluruh riwayat KGB milik pegawai. --}}
                    @forelse($riwayatKGBs as $riwayat)
                        <tr>

                            {{-- Nomor urut akan diatur oleh DataTables. --}}
                            <td></td>

                            {{-- Menampilkan nomor SK. --}}
                            <td>
                                {{ $riwayat->nomor_sk }}
                            </td>

                            {{-- Menampilkan tanggal SK. --}}
                            <td>
                                {{ $riwayat->tanggal_sk?->format('d-m-Y') }}
                            </td>

                            {{-- Menampilkan TMT KGB. --}}
                            <td>
                                {{ $riwayat->tmt?->format('d-m-Y') }}
                            </td>

                            {{-- Menampilkan keterangan. --}}
                            <td>
                                {{ $riwayat->keterangan ?? '-' }}
                            </td>

                            <td class="text-center">

                                {{-- Tombol Detail. --}}
                                <a href="{{ route('pegawais.riwayat-kgb.show', [$pegawai, $riwayat]) }}"
                                    class="btn btn-info btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Tombol Edit. --}}
                                <a href="{{ route('pegawais.riwayat-kgb.edit', [$pegawai, $riwayat]) }}"
                                    class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Tombol Hapus. --}}
                                <form action="{{ route('pegawais.riwayat-kgb.destroy', [$pegawai, $riwayat]) }}"
                                    method="POST" class="d-inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat KGB ini?')">

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
                            <td colspan="6" class="text-center">
                                Belum ada riwayat KGB untuk pegawai ini.
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

            // Mengaktifkan DataTables pada tabel riwayat KGB.
            let table = $('#table-riwayat-kgb').DataTable({

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

                // Mengatur posisi elemen DataTables.
                dom: 'Bfrtip',

                buttons: [

                    {
                        // Tombol Copy.
                        extend: 'copyHtml5',

                        text: '<i class="fas fa-copy"></i> Copy',

                        className: 'btn btn-secondary btn-sm',

                        title: 'Riwayat KGB - {{ $pegawai->nama }}',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4],

                            format: {
                                body: function(data, row, column) {

                                    // Nomor urut dibuat saat export.
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

                        title: 'Riwayat KGB - {{ $pegawai->nama }}',

                        filename: 'Riwayat_KGB_{{ $pegawai->nipy }}',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4],

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

                        title: 'Riwayat KGB - {{ $pegawai->nama }}',

                        filename: 'Riwayat_KGB_{{ $pegawai->nipy }}',

                        orientation: 'landscape',

                        pageSize: 'A4',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4],

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

                        title: 'Riwayat KGB - {{ $pegawai->nama }}',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4],

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

                // Menggunakan bahasa Indonesia.
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
                },

                // Menonaktifkan smart search.
                search: {
                    smart: false
                }

            });

            // Membuat nomor urut mengikuti pencarian dan sorting.
            table.on('order.dt search.dt draw.dt', function() {

                let i = 1;

                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell) {

                    // Mengisi nomor urut berdasarkan data yang sedang tampil.
                    cell.innerHTML = i++;

                });

            }).draw();

        });
    </script>
@endpush
