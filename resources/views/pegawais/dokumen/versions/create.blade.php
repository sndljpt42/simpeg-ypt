@extends('adminlte::page')

@section('title', 'Upload Versi Dokumen')

@section('content_header')
    <h1>Upload Versi Dokumen</h1>
@stop

@section('content')
    {{-- Menampilkan kesalahan validasi dalam satu ringkasan. --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>File belum dapat diunggah:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informasi Pegawai</h3>
        </div>

        <div class="card-body">
            <p class="mb-1"><strong>Nama:</strong> {{ $pegawai->nama }}</p>
            <p class="mb-0"><strong>NIPY:</strong> {{ $pegawai->nipy ?? '-' }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dokumen</h3>
        </div>

        <div class="card-body">
            <p class="mb-0"><strong>Nama dokumen:</strong> {{ $dokumen->nama }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- enctype diperlukan agar browser mengirim isi file. --}}
            <form action="{{ route('pegawais.dokumen.versions.store', [$pegawai, $dokumen]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="file">Pilih File</label>

                    <input type="file" name="file" id="file"
                        class="form-control-file @error('file') is-invalid @enderror"
                        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx" required>

                    @error('file')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror

                    <small class="form-text text-muted">
                        Format PDF, gambar, Word, atau Excel; ukuran maksimal 3 MB.
                    </small>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i>
                    Upload Versi
                </button>

                <a href="{{ route('pegawais.dokumen.index', $pegawai) }}" class="btn btn-secondary">
                    Kembali
                </a>
            </form>
        </div>
    </div>
@stop
