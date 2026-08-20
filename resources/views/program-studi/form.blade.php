{{-- Menampilkan error validasi jika ada. --}}
@if ($errors->any())

    <div class="alert alert-danger">

        <strong>Terjadi kesalahan:</strong>

        <ul class="mb-0">

            {{-- Menampilkan seluruh pesan validasi. --}}
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif

{{-- Field Unit Kerja. --}}
<div class="form-group">

    <label for="unit_kerja_id">
        Unit Kerja
    </label>

    <select name="unit_kerja_id" id="unit_kerja_id" class="form-control @error('unit_kerja_id') is-invalid @enderror">

        {{-- Pilihan awal. --}}
        <option value="">
            -- Pilih Unit Kerja --
        </option>

        {{-- Menampilkan seluruh Unit Kerja dari Controller. --}}
        @foreach ($unitKerjas as $unitKerja)
            <option value="{{ $unitKerja->id }}"
                {{ old('unit_kerja_id', $programStudi->unit_kerja_id ?? '') == $unitKerja->id ? 'selected' : '' }}>
                {{ $unitKerja->nama }}
            </option>
        @endforeach

    </select>

    {{-- Menampilkan pesan error khusus Unit Kerja. --}}
    @error('unit_kerja_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>

{{-- Field Nama Program Studi. --}}
<div class="form-group">

    <label for="nama">
        Nama Program Studi
    </label>

    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $programStudi->nama ?? '') }}" placeholder="Masukkan nama Program Studi">

    {{-- Menampilkan pesan error khusus nama. --}}
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
<a href="{{ route('program-studi.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i>
    Kembali
</a>
