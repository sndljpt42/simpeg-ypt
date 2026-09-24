@extends('adminlte::page')

{{-- Judul halaman pada browser. --}}
@section('title', 'Detail Riwayat KGB')

{{-- Judul halaman. --}}
@section('content_header')
    <h1>Detail Riwayat KGB</h1>
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

                        {{-- Konteks halaman. --}}
                        <div class="col-md-3 mt-3 mt-md-0">

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


            {{-- Detail Riwayat KGB. --}}
            <div class="table-responsive">

                <table class="table table-bordered">

                    <tbody>

                        <tr>
                            <th width="220">
                                Nomor SK
                            </th>

                            <td>
                                {{ $riwayatKGB->nomor_sk }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Tanggal SK
                            </th>

                            <td>
                                {{ $riwayatKGB->tanggal_sk?->format('d-m-Y') }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                TMT
                            </th>

                            <td>
                                {{ $riwayatKGB->tmt?->format('d-m-Y') }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Keterangan
                            </th>

                            <td>
                                {{ $riwayatKGB->keterangan ?? '-' }}
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- Tombol aksi. --}}
            <div class="mt-4">

                {{-- Kembali ke daftar riwayat KGB. --}}
                <a href="{{ route('pegawais.riwayat-kgb.index', $pegawai) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>

                {{-- Edit riwayat KGB. --}}
                <a href="{{ route('pegawais.riwayat-kgb.edit', [
                    'pegawai' => $pegawai,
                    'riwayat_kgb' => $riwayatKGB,
                ]) }}"
                    class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>

            </div>

        </div>

    </div>

@stop
