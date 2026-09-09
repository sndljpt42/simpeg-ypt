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

{{-- Field Golongan. --}}
<div class="form-group">

    <label for="golongan">
        Golongan
    </label>

    <input type="text" name="golongan" id="golongan" class="form-control @error('golongan') is-invalid @enderror"
        value="{{ old('golongan', $golongan->golongan ?? '') }}" placeholder="Masukan golongan">

    @error('golongan')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>

{{-- Field Ruang. --}}
<div class="form-group">

    <label for="ruang">
        Ruang
    </label>

    <input type="text" name="ruang" id="ruang" class="form-control @error('ruang') is-invalid @enderror"
        value="{{ old('ruang', $golongan->ruang ?? '') }}" placeholder="Masukan ruang">

    @error('ruang')
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
<a href="{{ route('golongan.index') }}" class="btn btn-secondary">

    <i class="fas fa-arrow-left"></i>
    Kembali

</a>
