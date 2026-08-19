{{-- Field form Unit Kerja digunakan bersama oleh Create dan Edit. --}}

<div class="form-group">

    {{-- Label untuk field nama Unit Kerja. --}}
    <label for="nama">Nama Unit Kerja</label>

    {{-- Input nama Unit Kerja. --}}
    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $unitKerja->nama ?? '') }}" placeholder="Masukkan nama Unit Kerja">

    {{-- Menampilkan pesan validasi jika field nama bermasalah. --}}
    @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>

{{-- Tombol kembali ke halaman daftar Unit Kerja. --}}
<a href="{{ route('unit-kerja.index') }}" class="btn btn-secondary">

    <i class="fas fa-arrow-left"></i>

    Kembali

</a>

{{-- Tombol untuk mengirim data form. --}}
<button type="submit" class="btn btn-primary">

    <i class="fas fa-save"></i>

    Simpan

</button>
