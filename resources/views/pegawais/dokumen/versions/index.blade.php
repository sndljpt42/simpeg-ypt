@extends('adminlte::page')

@section('title', 'Riwayat Versi Dokumen')

@section('content_header')
    <h1>
        <i class="fas fa-history mr-1"></i>
        Riwayat Versi Dokumen
    </h1>
@stop

@section('content')
    @php
        // Koleksi sudah diurutkan dari versi terbaru oleh controller.
        $versiTerbaru = $versions->first();
    @endphp

    {{-- Konteks pegawai agar pengguna tahu dokumen siapa yang sedang dilihat. --}}
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user mr-1"></i>
                Informasi Pegawai
            </h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <strong>Nama</strong>
                    <div>{{ $pegawai->nama }}</div>
                </div>

                <div class="col-md-4">
                    <strong>NIPY</strong>
                    <div>{{ $pegawai->nipy ?? '-' }}</div>
                </div>

                <div class="col-md-4">
                    <strong>Unit Kerja</strong>
                    <div>{{ $pegawai->unitKerja?->nama ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Identitas dokumen dan navigasi utama halaman. --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-file-alt mr-1"></i>
                {{ $dokumen->nama }}
            </h3>

            <div class="card-tools">
                <a href="{{ route('pegawais.dokumen.versions.create', [$pegawai, $dokumen]) }}"
                    class="btn btn-primary btn-sm">
                    <i class="fas fa-upload"></i>
                    Upload Versi
                </a>
            </div>
        </div>

        <div class="card-body">
            <p class="mb-0">{{ $dokumen->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
        </div>
    </div>

    {{-- Ringkasan dinamis dari versi terbaru dan jumlah arsip versi. --}}
    <div class="row">
        <div class="col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-primary">
                    <i class="fas fa-layer-group"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Versi</span>
                    <span class="info-box-number">{{ $versions->count() }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-success">
                    <i class="fas fa-star"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">Versi Terbaru</span>
                    <span class="info-box-number">
                        {{ $versiTerbaru ? 'Versi ' . $versiTerbaru->version : '-' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Versi</h3>
        </div>

        <div class="card-body">
            @if ($versions->isEmpty())
                <div class="alert alert-info mb-0">
                    <i class="fas fa-info-circle mr-1"></i>
                    Belum ada versi untuk dokumen ini. Gunakan tombol
                    <strong>Upload Versi</strong> untuk menambahkan versi pertama.
                </div>
            @else
                <div class="table-responsive">
                    <table id="table-versi" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="100">Versi</th>
                                <th>Nama File</th>
                                <th width="180">Format</th>
                                <th width="130">Ukuran</th>
                                <th width="180">Tanggal Unggah</th>
                                <th width="120">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($versions as $version)
                                <tr class="{{ $loop->first ? 'table-success' : '' }}">
                                    <td>
                                        <strong>Versi {{ $version->version }}</strong>
                                    </td>

                                    <td>{{ $version->nama_file }}</td>

                                    <td>{{ strtoupper(pathinfo($version->nama_file, PATHINFO_EXTENSION)) ?: '-' }}</td>

                                    <td>
                                        @if ($version->ukuran >= 1048576)
                                            {{ number_format($version->ukuran / 1048576, 2) }} MB
                                        @else
                                            {{ number_format($version->ukuran / 1024, 1) }} KB
                                        @endif
                                    </td>

                                    <td>
                                        {{ $version->created_at?->format('d-m-Y H:i') ?? '-' }}
                                    </td>

                                    <td>
                                        @if ($loop->first)
                                            <span class="badge badge-success">Terbaru</span>
                                        @else
                                            <span class="badge badge-secondary">Arsip</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="card-footer">
            <a href="{{ route('pegawais.dokumen.index', $pegawai) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Repository
            </a>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)

@push('js')
    <script>
        $(function() {
            $('#table-versi').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                order: [
                    [0, 'desc']
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
                }
            });
        });
    </script>
@endpush
