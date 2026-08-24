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

{{-- Field Nama Jenis Pegawai. --}}
<div class="form-group">

    <label for="nama">
        Nama Jenis Pegawai
    </label>

    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $jenisPegawai->nama ?? '') }}" placeholder="Masukan jenis pegawai">

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

{{-- Tombol kembali ke Index. --}}
<a href="{{ route('jenis-pegawai.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i>
    Kembali
</a>
