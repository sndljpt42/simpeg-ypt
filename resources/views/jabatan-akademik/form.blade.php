{{-- Field form Jabatan Akademik digunakan bersama oleh Create dan Edit. --}}

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


{{-- Field Nama Jabatan Akademik. --}}
<div class="form-group">

    <label for="nama">
        Nama Jabatan Akademik
    </label>

    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $jabatanAkademik->nama ?? '') }}" placeholder="Masukkan nama Jabatan Akademik">

    {{-- Menampilkan pesan error khusus nama. --}}
    @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Field Golongan Minimal. --}}
<div class="form-group">

    <label for="golongan_min_id">
        Golongan Minimal
    </label>

    <select name="golongan_min_id" id="golongan_min_id"
        class="form-control @error('golongan_min_id') is-invalid @enderror">

        {{-- Pilihan awal. --}}
        <option value="">
            -- Pilih Golongan Minimal --
        </option>

        {{-- Menampilkan seluruh Golongan dari Controller. --}}
        @foreach ($golongans as $golongan)
            <option value="{{ $golongan->id }}"
                {{ old('golongan_min_id', $jabatanAkademik->golongan_min_id ?? '') == $golongan->id ? 'selected' : '' }}>
                {{ $golongan->kode }}
            </option>
        @endforeach

    </select>

    {{-- Menampilkan pesan error khusus Golongan Minimal. --}}
    @error('golongan_min_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Field Golongan Maksimal. --}}
<div class="form-group">

    <label for="golongan_max_id">
        Golongan Maksimal
    </label>

    <select name="golongan_max_id" id="golongan_max_id"
        class="form-control @error('golongan_max_id') is-invalid @enderror">

        {{-- Pilihan awal. --}}
        <option value="">
            -- Pilih Golongan Maksimal --
        </option>

        {{-- Menampilkan seluruh Golongan dari Controller. --}}
        @foreach ($golongans as $golongan)
            <option value="{{ $golongan->id }}"
                {{ old('golongan_max_id', $jabatanAkademik->golongan_max_id ?? '') == $golongan->id ? 'selected' : '' }}>
                {{ $golongan->kode }}
            </option>
        @endforeach

    </select>

    {{-- Menampilkan pesan error khusus Golongan Maksimal. --}}
    @error('golongan_max_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Field Usia Pensiun. --}}
<div class="form-group">

    <label for="usia_pensiun">
        Usia Pensiun
    </label>

    <div class="input-group">

        <input type="number" name="usia_pensiun" id="usia_pensiun"
            class="form-control @error('usia_pensiun') is-invalid @enderror"
            value="{{ old('usia_pensiun', $jabatanAkademik->usia_pensiun ?? '') }}"
            placeholder="Masukkan usia pensiun">

        <div class="input-group-append">
            <span class="input-group-text">
                tahun
            </span>
        </div>

        {{-- Menampilkan pesan error khusus Usia Pensiun. --}}
        @error('usia_pensiun')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

</div>


{{-- Field Maks. KGB Setelah Mentok. --}}
<div class="form-group">

    <label for="maks_kgb_setelah_mentok">
        Maks. KGB Setelah Mentok
    </label>

    <input type="number" name="maks_kgb_setelah_mentok" id="maks_kgb_setelah_mentok"
        class="form-control @error('maks_kgb_setelah_mentok') is-invalid @enderror"
        value="{{ old('maks_kgb_setelah_mentok', $jabatanAkademik->maks_kgb_setelah_mentok ?? '') }}"
        placeholder="Masukkan maksimal KGB setelah mentok">

    {{-- Menampilkan pesan error khusus Maks. KGB Setelah Mentok. --}}
    @error('maks_kgb_setelah_mentok')
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
<a href="{{ route('jabatan-akademik.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i>
    Kembali
</a>
