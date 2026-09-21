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


            {{-- Status Golongan saat ini. --}}
            <div class="col-md-4 mt-3 mt-md-0">

                <div class="border-left pl-3">

                    <div class="text-muted small">
                        GOLONGAN SAAT INI
                    </div>

                    @if ($pegawai->golongan)
                        <div class="d-flex align-items-center mt-1">

                            <i class="fas fa-layer-group text-primary mr-2"></i>

                            <span class="font-weight-bold">
                                {{ $pegawai->golongan->kode }}
                            </span>

                        </div>
                    @else
                        <div class="text-muted mt-1">
                            <i class="fas fa-minus-circle mr-1"></i>
                            Belum ada golongan
                        </div>
                    @endif

                </div>

            </div>


            {{-- Penanda konteks halaman. --}}
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

{{-- Menampilkan pesan validasi jika ada error. --}}
@if ($errors->any())

    <div class="alert alert-danger">

        <strong>Terjadi kesalahan:</strong>

        <ul class="mb-0 mt-2">

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif


{{-- Pilihan Golongan. --}}
<div class="form-group">

    <label for="golongan_id">
        Golongan
    </label>

    <select name="golongan_id" id="golongan_id" class="form-control">

        <option value="">
            -- Pilih Golongan --
        </option>

        @foreach ($golongans as $golongan)
            <option value="{{ $golongan->id }}"
                {{ old('golongan_id', $riwayatGolongan->golongan_id ?? '') == $golongan->id ? 'selected' : '' }}>
                {{ $golongan->kode }}
            </option>
        @endforeach

    </select>

</div>


{{-- Nomor SK. --}}
<div class="form-group">

    <label for="nomor_sk">
        Nomor SK
    </label>

    <input type="text" name="nomor_sk" id="nomor_sk" class="form-control"
        value="{{ old('nomor_sk', $riwayatGolongan->nomor_sk ?? '') }}" placeholder="Masukkan nomor SK">

</div>


{{-- Tanggal SK. --}}
<div class="form-group">

    <label for="tanggal_sk">
        Tanggal SK
    </label>

    <input type="date" name="tanggal_sk" id="tanggal_sk" class="form-control"
        value="{{ old('tanggal_sk', isset($riwayatGolongan) ? $riwayatGolongan->tanggal_sk?->format('Y-m-d') : '') }}">

</div>


{{-- TMT Golongan. --}}
<div class="form-group">

    <label for="tmt">
        TMT
    </label>

    <input type="date" name="tmt" id="tmt" class="form-control"
        value="{{ old('tmt', isset($riwayatGolongan) ? $riwayatGolongan->tmt?->format('Y-m-d') : '') }}">

</div>


{{-- Keterangan tambahan. --}}
<div class="form-group">

    <label for="keterangan">
        Keterangan
    </label>

    <textarea name="keterangan" id="keterangan" class="form-control" rows="4"
        placeholder="Keterangan tambahan jika ada">{{ old('keterangan', $riwayatGolongan->keterangan ?? '') }}</textarea>

</div>


{{-- Tombol aksi form. --}}
<div class="mt-4">

    {{-- Kembali ke halaman Index Riwayat Golongan. --}}
    <a href="{{ route('pegawais.riwayat-golongan.index', $pegawai) }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        Kembali
    </a>

    {{-- Tombol menyimpan data. --}}
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i>
        Simpan
    </button>

</div>
