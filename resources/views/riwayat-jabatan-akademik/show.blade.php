@extends('adminlte::page')

{{-- Judul halaman pada browser. --}}
@section('title', 'Detail Riwayat Jabatan Akademik')

{{-- Judul halaman. --}}
@section('content_header')
    <h1>Detail Riwayat Jabatan Akademik</h1>
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


                        {{-- Jabatan Akademik saat ini. --}}
                        <div class="col-md-4 mt-3 mt-md-0">

                            <div class="border-left pl-3">

                                <div class="text-muted small">
                                    JABATAN AKADEMIK SAAT INI
                                </div>

                                @if ($pegawai->jabatanAkademik)
                                    <div class="font-weight-bold mt-1">

                                        <i class="fas fa-graduation-cap text-primary mr-1"></i>

                                        {{ $pegawai->jabatanAkademik->nama }}

                                    </div>
                                @else
                                    <div class="text-muted mt-1">
                                        Belum ada jabatan akademik
                                    </div>
                                @endif

                            </div>

                        </div>


                        {{-- Konteks riwayat. --}}
                        <div class="col-md-3 mt-3 mt-md-0">

                            <div class="border-left pl-3">

                                <div class="text-muted small">
                                    RIWAYAT
                                </div>

                                <div class="font-weight-bold mt-1">

                                    <i class="fas fa-history text-info mr-1"></i>

                                    Jabatan Akademik

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Detail Riwayat Jabatan Akademik. --}}
            <div class="table-responsive">

                <table class="table table-bordered">

                    <tbody>

                        <tr>

                            <th width="220">
                                Jabatan Akademik
                            </th>

                            <td>
                                {{ $riwayatJabatanAkademik->jabatanAkademik->nama }}
                            </td>

                        </tr>


                        <tr>

                            <th>
                                Nomor SK
                            </th>

                            <td>
                                {{ $riwayatJabatanAkademik->nomor_sk }}
                            </td>

                        </tr>


                        <tr>

                            <th>
                                Tanggal SK
                            </th>

                            <td>
                                {{ $riwayatJabatanAkademik->tanggal_sk?->format('d-m-Y') }}
                            </td>

                        </tr>


                        <tr>

                            <th>
                                TMT
                            </th>

                            <td>
                                {{ $riwayatJabatanAkademik->tmt?->format('d-m-Y') }}
                            </td>

                        </tr>


                        <tr>

                            <th>
                                Keterangan
                            </th>

                            <td>
                                {{ $riwayatJabatanAkademik->keterangan ?? '-' }}
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- Tombol aksi. --}}
            <div class="mt-3">

                {{-- Kembali ke halaman Index Riwayat Jabatan Akademik. --}}
                <a href="{{ route('pegawais.riwayat-jabatan-akademik.index', $pegawai) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>


                {{-- Menuju halaman Edit Riwayat Jabatan Akademik. --}}
                <a href="{{ route('pegawais.riwayat-jabatan-akademik.edit', [$pegawai, $riwayatJabatanAkademik]) }}"
                    class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>

            </div>

        </div>

    </div>

@stop
