{{-- Menampilkan seluruh error validasi. --}}
@if ($errors->any())

    <div class="alert alert-danger">

        <strong>Terjadi kesalahan:</strong>

        <ul class="mb-0">

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif

{{-- Field Nama Status Pegawai. --}}
<div class="form-group">

    <label for="nama">
        Nama Status Pegawai
    </label>

    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $statusPegawai->nama ?? '') }}" placeholder="Masukkan nama status pegawai">

    @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>

{{-- Tombol Simpan. --}}
<button type="submit" class="btn btn-primary">

    <i class="fas fa-save"></i>
    Simpan

</button>

{{-- Tombol kembali. --}}
<a href="{{ route('status-pegawai.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i>
    Kembali
</a>
