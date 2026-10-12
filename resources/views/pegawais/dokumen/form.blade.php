{{-- Menampilkan informasi pegawai yang sedang dikelola. --}}
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

            {{-- Pemisah informasi pegawai dengan konteks halaman. --}}
            <div class="d-none d-md-block"
                style="
                    width: 1px;
                    height: 42px;
                    background-color: #dee2e6;
                ">
            </div>

            {{-- Informasi konteks halaman. --}}
            <div class="col-md-6 ml-md-3 mt-3 mt-md-0">

                <div class="text-muted small" style="letter-spacing: 0.5px;">
                    REPOSITORY
                </div>

                <div class="font-weight-bold">
                    <i class="fas fa-folder-open text-info mr-2"></i>
                    DOKUMEN
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


{{-- Nama dokumen. --}}
<div class="form-group">

    <label for="nama">
        Nama Dokumen
    </label>

    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $dokumen->nama ?? '') }}">

    {{-- Menampilkan error khusus Nama Dokumen. --}}
    @error('nama')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror

</div>


{{-- Deskripsi dokumen. --}}
<div class="form-group">

    <label for="deskripsi">
        Deskripsi
    </label>

    <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $dokumen->deskripsi ?? '') }}</textarea>

    {{-- Menampilkan error khusus Deskripsi. --}}
    @error('deskripsi')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror

</div>


{{-- Tombol kembali dan simpan. --}}
<div class="mt-4">

    {{-- Kembali ke Repository Dokumen pegawai. --}}
    <a href="{{ route('pegawais.dokumen.index', $pegawai) }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        Kembali
    </a>

    {{-- Mengirim data form ke controller. --}}
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i>
        Simpan
    </button>

</div>
