{{-- Informasi pegawai yang sedang dikelola. --}}
<div class="card mb-3">

    <div class="card-body py-3">

        <div class="row align-items-center">

            {{-- Identitas pegawai. --}}
            <div class="col-md-5 d-flex align-items-center">

                {{-- Ikon pegawai. --}}
                <div class="d-flex align-items-center justify-content-center mr-3"
                    style="
                        width: 44px;
                        height: 44px;
                        border-radius: 50%;
                        background-color: #007bff;
                        color: white;
                        flex-shrink: 0;
                    ">
                    <i class="fas fa-user"></i>
                </div>

                {{-- Nama dan NIPY pegawai. --}}
                <div>

                    {{-- Nama pegawai. --}}
                    <div class="font-weight-bold">
                        {{ $pegawai->nama }}
                    </div>

                    {{-- NIPY pegawai. --}}
                    <div class="text-muted small">
                        <i class="fas fa-id-card mr-1"></i>
                        NIPY: {{ $pegawai->nipy }}
                    </div>

                </div>

            </div>


            {{-- Pemisah vertikal seperti pada tampilan index. --}}
            <div class="d-none d-md-block"
                style="
                    width: 1px;
                    height: 42px;
                    background-color: #dee2e6;
                ">
            </div>


            {{-- Informasi konteks halaman. --}}
            <div class="col-md-6 ml-md-3 mt-3 mt-md-0">

                {{-- Label konteks. --}}
                <div class="text-muted small" style="letter-spacing: 0.5px;">
                    RIWAYAT
                </div>

                {{-- Modul yang sedang dikelola. --}}
                <div class="font-weight-bold">

                    <i class="fas fa-history text-info mr-2"></i>

                    KGB

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


{{-- Nomor SK KGB. --}}
<div class="form-group">

    <label for="nomor_sk">
        Nomor SK
    </label>

    <input type="text" name="nomor_sk" id="nomor_sk" class="form-control @error('nomor_sk') is-invalid @enderror"
        value="{{ old('nomor_sk', $riwayatKGB->nomor_sk ?? '') }}">

    {{-- Menampilkan error khusus Nomor SK. --}}
    @error('nomor_sk')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror

</div>


{{-- Tanggal SK KGB. --}}
<div class="form-group">

    <label for="tanggal_sk">
        Tanggal SK
    </label>

    <input type="date" name="tanggal_sk" id="tanggal_sk"
        class="form-control @error('tanggal_sk') is-invalid @enderror"
        value="{{ old(
            'tanggal_sk',
            isset($riwayatKGB) && $riwayatKGB->tanggal_sk ? $riwayatKGB->tanggal_sk->format('Y-m-d') : '',
        ) }}">

    {{-- Menampilkan error khusus Tanggal SK. --}}
    @error('tanggal_sk')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror

</div>


{{-- TMT KGB. --}}
<div class="form-group">

    <label for="tmt">
        TMT
    </label>

    <input type="date" name="tmt" id="tmt" class="form-control @error('tmt') is-invalid @enderror"
        value="{{ old('tmt', isset($riwayatKGB) && $riwayatKGB->tmt ? $riwayatKGB->tmt->format('Y-m-d') : '') }}">

    {{-- Menampilkan error khusus TMT. --}}
    @error('tmt')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror

</div>


{{-- Keterangan Riwayat KGB. --}}
<div class="form-group">

    <label for="keterangan">
        Keterangan
    </label>

    <textarea name="keterangan" id="keterangan" rows="4"
        class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $riwayatKGB->keterangan ?? '') }}</textarea>

    {{-- Menampilkan error khusus Keterangan. --}}
    @error('keterangan')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror

</div>


{{-- Tombol kembali dan simpan. --}}
<div class="mt-4">

    {{-- Kembali ke daftar Riwayat KGB pegawai. --}}
    <a href="{{ route('pegawais.riwayat-kgb.index', $pegawai) }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        Kembali
    </a>

    {{-- Mengirim data form ke controller. --}}
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i>
        Simpan
    </button>

</div>
