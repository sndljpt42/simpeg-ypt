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


            {{-- Konteks halaman. --}}
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


{{-- Menampilkan seluruh pesan validasi. --}}
@if ($errors->any())

    <div class="alert alert-danger">

        <strong>Terjadi kesalahan:</strong>

        <ul class="mb-0 mt-2">

            @foreach ($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach

        </ul>

    </div>

@endif


{{-- Jabatan Akademik. --}}
<div class="form-group">

    <label for="jabatan_akademik_id">
        Jabatan Akademik
    </label>

    <select name="jabatan_akademik_id" id="jabatan_akademik_id"
        class="form-control @error('jabatan_akademik_id') is-invalid @enderror">

        <option value="">
            -- Pilih Jabatan Akademik --
        </option>

        @foreach ($jabatanAkademiks as $jabatanAkademik)
            <option value="{{ $jabatanAkademik->id }}"
                {{ old('jabatan_akademik_id', $riwayatJabatanAkademik->jabatan_akademik_id ?? '') == $jabatanAkademik->id
                    ? 'selected'
                    : '' }}>
                {{ $jabatanAkademik->nama }}
            </option>
        @endforeach

    </select>

    {{-- Pesan error Jabatan Akademik. --}}
    @error('jabatan_akademik_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Nomor SK. --}}
<div class="form-group">

    <label for="nomor_sk">
        Nomor SK
    </label>

    <input type="text" name="nomor_sk" id="nomor_sk" class="form-control @error('nomor_sk') is-invalid @enderror"
        value="{{ old('nomor_sk', $riwayatJabatanAkademik->nomor_sk ?? '') }}"
        placeholder="Masukkan nomor SK">

    {{-- Pesan error Nomor SK. --}}
    @error('nomor_sk')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Tanggal SK. --}}
<div class="form-group">

    <label for="tanggal_sk">
        Tanggal SK
    </label>

    <input type="date" name="tanggal_sk" id="tanggal_sk"
        class="form-control @error('tanggal_sk') is-invalid @enderror"
        value="{{ old(
            'tanggal_sk',
            isset($riwayatJabatanAkademik) ? $riwayatJabatanAkademik->tanggal_sk?->format('Y-m-d') : '',
        ) }}">

    {{-- Pesan error Tanggal SK. --}}
    @error('tanggal_sk')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- TMT. --}}
<div class="form-group">

    <label for="tmt">
        TMT
    </label>

    <input type="date" name="tmt" id="tmt" class="form-control @error('tmt') is-invalid @enderror"
        value="{{ old('tmt', isset($riwayatJabatanAkademik) ? $riwayatJabatanAkademik->tmt?->format('Y-m-d') : '') }}">

    {{-- Pesan error TMT. --}}
    @error('tmt')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Keterangan. --}}
<div class="form-group">

    <label for="keterangan">
        Keterangan
    </label>

    <textarea name="keterangan" id="keterangan" rows="4"
        class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan tambahan jika ada">{{ old('keterangan', $riwayatJabatanAkademik->keterangan ?? '') }}</textarea>

    {{-- Pesan error Keterangan. --}}
    @error('keterangan')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Tombol aksi form. --}}
<div class="mt-4">

    {{-- Kembali ke halaman Index. --}}
    <a href="{{ route('pegawais.riwayat-jabatan-akademik.index', $pegawai) }}"
        class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        Kembali
    </a>

    {{-- Simpan data Create atau Edit. --}}
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i>
        Simpan
    </button>

</div>
