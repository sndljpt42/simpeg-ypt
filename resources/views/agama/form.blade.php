{{-- Menampilkan error validasi jika terdapat kesalahan. --}}
@if ($errors->any())

    <div class="alert alert-danger">

        <strong>Terjadi kesalahan:</strong>

        <ul class="mb-0">

            {{-- Menampilkan seluruh pesan validasi dari Laravel. --}}
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif

{{-- Field Nama Agama. --}}
<div class="form-group">

    <label for="nama">
        Nama Agama
    </label>

    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $agama->nama ?? '') }}" placeholder="Masukkan nama agama">

    {{-- Menampilkan pesan error khusus field nama. --}}
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
<a href="{{ route('agama.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i>
    Kembali
</a>
