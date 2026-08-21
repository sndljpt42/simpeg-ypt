{{-- Menampilkan seluruh error validasi jika terdapat kesalahan. --}}
@if ($errors->any())

    <div class="alert alert-danger">

        <strong>Terjadi kesalahan:</strong>

        <ul class="mb-0">

            {{-- Menampilkan setiap pesan validasi. --}}
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif

{{-- Field Nama Pendidikan. --}}
<div class="form-group">

    <label for="nama">
        Nama Pendidikan
    </label>

    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $pendidikan->nama ?? '') }}" placeholder="Masukkan nama pendidikan">

    {{-- Menampilkan pesan validasi khusus field nama. --}}
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

{{-- Tombol kembali ke Index Pendidikan. --}}
<a href="{{ route('pendidikan.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i>
    Kembali
</a>
