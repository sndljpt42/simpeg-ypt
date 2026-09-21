@extends('adminlte::page')

{{-- Judul halaman pada browser. --}}
@section('title', 'Detail Riwayat Golongan')

{{-- Judul halaman. --}}
@section('content_header')
    <h1>Detail Riwayat Golongan</h1>
@stop

{{-- Isi utama halaman. --}}
@section('content')

    <div class="card">

        <div class="card-body">

            {{-- Informasi pegawai yang memiliki riwayat ini. --}}
            <div class="card bg-light border mb-4">

                <div class="card-body py-3">

                    <div class="row align-items-center">

                        {{-- Identitas pegawai. --}}
                        <div class="col-md-6">

                            <div class="d-flex align-items-center">

                                <div class="mr-3">

                                    <span class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 48px; height: 48px;">
                                        <i class="fas fa-user text-white"></i>
                                    </span>

                                </div>

                                <div>

                                    <h5 class="mb-1 font-weight-bold">
                                        {{ $pegawai->nama }}
                                    </h5>

                                    <div class="text-muted">
                                        <i class="fas fa-id-card mr-1"></i>
                                        NIPY: {{ $pegawai->nipy }}
                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- Golongan saat ini. --}}
                        <div class="col-md-3 mt-3 mt-md-0">

                            <div class="border-left pl-3">

                                <div class="text-muted small">
                                    GOLONGAN SAAT INI
                                </div>

                                <div class="font-weight-bold mt-1">

                                    @if ($pegawai->golongan)
                                        <i class="fas fa-layer-group text-primary mr-1"></i>
                                        {{ $pegawai->golongan->kode }}
                                    @else
                                        <span class="text-muted">
                                            Belum ada golongan
                                        </span>
                                    @endif

                                </div>

                            </div>

                        </div>

                        {{-- Konteks halaman. --}}
                        <div class="col-md-3 mt-3 mt-md-0">

                            <div class="border-left pl-3">

                                <div class="text-muted small">
                                    RIWAYAT
                                </div>

                                <div class="font-weight-bold mt-1">
                                    <i class="fas fa-history text-info mr-1"></i>
                                    Golongan
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Detail Riwayat Golongan. --}}
            <div class="table-responsive">

                <table class="table table-bordered">

                    <tbody>

                        <tr>
                            <th width="220">
                                Golongan
                            </th>

                            <td>
                                {{ $riwayatGolongan->golongan->kode }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Nomor SK
                            </th>

                            <td>
                                {{ $riwayatGolongan->nomor_sk }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Tanggal SK
                            </th>

                            <td>
                                {{ $riwayatGolongan->tanggal_sk?->format('d-m-Y') }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                TMT
                            </th>

                            <td>
                                {{ $riwayatGolongan->tmt?->format('d-m-Y') }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Keterangan
                            </th>

                            <td>
                                {{ $riwayatGolongan->keterangan ?? '-' }}
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- Tombol aksi. --}}
            <div class="mt-4">

                {{-- Kembali ke daftar riwayat. --}}
                <a href="{{ route('pegawais.riwayat-golongan.index', $pegawai) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>

                {{-- Edit riwayat. --}}
                <a href="{{ route('pegawais.riwayat-golongan.edit', [$pegawai, $riwayatGolongan]) }}"
                    class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>

            </div>

        </div>

    </div>

@stop
