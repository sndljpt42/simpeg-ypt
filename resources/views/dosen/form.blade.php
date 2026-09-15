{{-- ========================================================= --}}
{{-- Jenis Pegawai (otomatis Dosen) --}}
{{-- ========================================================= --}}
<input type="hidden" name="jenis_pegawai_id" value="{{ $jenisPegawais->id }}">


{{-- ========================================================= --}}
{{-- DATA KEPEGAWAIAN --}}
{{-- ========================================================= --}}
<div class="card card-primary card-outline">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-id-card mr-2"></i>
            Data Kepegawaian
        </h3>
    </div>

    <div class="card-body">
        <div class="row">

            {{-- NIPY --}}
            <div class="col-md-4">
                <div class="form-group">

                    <label>
                        NIPY <span class="text-danger">*</span>
                    </label>

                    <input type="text" name="nipy" class="form-control @error('nipy') is-invalid @enderror"
                        value="{{ old('nipy', $pegawai->nipy ?? '') }}" placeholder="Masukkan NIPY">

                    @error('nipy')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>


            {{-- NUPTK --}}
            <div class="col-md-4">
                <div class="form-group">

                    <label>
                        NUPTK <span class="text-danger">*</span>
                    </label>

                    <input type="text" name="nuptk" class="form-control @error('nuptk') is-invalid @enderror"
                        value="{{ old('nuptk', $pegawai->nuptk ?? '') }}" placeholder="Masukkan NUPTK">

                    @error('nuptk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>


            {{-- JENIS DOSEN --}}
            <div class="col-md-4">
                <div class="form-group">

                    <label>
                        Jenis Dosen <span class="text-danger">*</span>
                    </label>

                    <select name="jenis_dosen" class="form-control @error('jenis_dosen') is-invalid @enderror">
                        <option value="">-- Pilih Jenis Dosen --</option>

                        <option value="Tetap" @selected(old('jenis_dosen', $pegawai->jenis_dosen ?? '') === 'Tetap')>
                            Tetap
                        </option>

                        <option value="Tidak Tetap" @selected(old('jenis_dosen', $pegawai->jenis_dosen ?? '') === 'Tidak Tetap')>
                            Tidak Tetap
                        </option>
                    </select>

                    @error('jenis_dosen')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>

        </div>


        <div class="row">

            {{-- UNIT KERJA --}}
            <div class="col-md-6">
                <div class="form-group">

                    <label>
                        Unit Kerja <span class="text-danger">*</span>
                    </label>

                    <select name="unit_kerja_id" class="form-control @error('unit_kerja_id') is-invalid @enderror">
                        <option value="">
                            -- Pilih Unit Kerja --
                        </option>
                        {{-- Menampilkan Unit Kerja sesuai struktur parent-child. --}}
                        @foreach ($unitKerjas as $unit)
                            <option value="{{ $unit->id }}" @selected(old('unit_kerja_id', $pegawai->unit_kerja_id ?? '') == $unit->id)>
                               {{ str_repeat('— ', $unit->hierarchy_level) }} {{ $unit->nama }}
                            </option>
                        @endforeach

                    </select>

                    @error('unit_kerja_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>

            {{-- Program Studi --}}
            <div class="col-md-6">
                <div class="form-group">

                    <label>Program Studi</label>

                    <select name="program_studi_id" id="program_studi_id"
                        class="form-control @error('program_studi_id') is-invalid @enderror" disabled>

                        <option value="">-- Pilih Program Studi --</option>

                    </select>

                    @error('program_studi_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>

            {{-- TMT PEGAWAI --}}
            <div class="col-md-6">
                <div class="form-group">

                    <label>
                        TMT <span class="text-danger">*</span>
                    </label>

                    <input type="date" name="tmt" class="form-control @error('tmt') is-invalid @enderror"
                        value="{{ old('tmt', $pegawai->tmt ?? '') }}">

                    @error('tmt')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>

            {{-- STATUS PEGAWAI --}}
            <div class="col-md-6">
                <div class="form-group">

                    <label>
                        Status Pegawai <span class="text-danger">*</span>
                    </label>

                    <select name="status_pegawai_id"
                        class="form-control @error('status_pegawai_id') is-invalid @enderror">
                        <option value="">
                            -- Pilih Status Pegawai --
                        </option>

                        @foreach ($statusPegawais as $status)
                            <option value="{{ $status->id }}" @selected(old('status_pegawai_id', $pegawai->status_pegawai_id ?? '') == $status->id)>
                                {{ $status->nama }}
                            </option>
                        @endforeach

                    </select>

                    @error('status_pegawai_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>

        </div>


    </div>
</div>


{{-- ========================================================= --}}
{{-- DATA SERTIFIKASI DOSEN --}}
{{-- ========================================================= --}}
<div class="card card-warning card-outline">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-certificate mr-2"></i>
            Data Sertifikasi Dosen
        </h3>
    </div>

    <div class="card-body">

        <div class="row">

            {{-- NO SERDOS --}}
            <div class="col-md-6">
                <div class="form-group">

                    <label>No. Serdos<span class="text-danger">*</label>

                    <input type="text" name="no_serdos" class="form-control @error('no_serdos') is-invalid @enderror"
                        value="{{ old('no_serdos', $pegawai->no_serdos ?? '') }}" placeholder="Masukkan No. Serdos">

                    @error('no_serdos')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>


            {{-- TANGGAL SERDOS --}}
            <div class="col-md-6">
                <div class="form-group">

                    <label>Tanggal Serdos</label>

                    <input type="date" name="tanggal_serdos"
                        class="form-control @error('tanggal_serdos') is-invalid @enderror"
                        value="{{ old('tanggal_serdos', $pegawai->tanggal_serdos ?? '') }}">

                    @error('tanggal_serdos')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>

        </div>

    </div>
</div>

{{-- ========================================================= --}}
{{-- DATA PRIBADI --}}
{{-- ========================================================= --}}
<div class="card card-success card-outline">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user"></i>
            Data Pribadi
        </h3>
    </div>

    <div class="card-body">

        <div class="form-group">

            <label>Nama Lengkap<span class="text-danger">*</span></label>

            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama', $pegawai->nama ?? '') }}">

            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label>Tempat Lahir<span class="text-danger">*</span></label>

                    <input type="text" name="tempat_lahir"
                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                        value="{{ old('tempat_lahir', $pegawai->tempat_lahir ?? '') }}">

                    @error('tempat_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label>Tanggal Lahir<span class="text-danger">*</span></label>

                    <input type="date" name="tanggal_lahir"
                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                        value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir ?? '') }}">

                    @error('tanggal_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label>Jenis Kelamin<span class="text-danger">*</span></label>

                    <div>

                        <div class="form-check form-check-inline">

                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="L"
                                @checked(old('jenis_kelamin', $pegawai->jenis_kelamin ?? '') == 'L')>

                            <label class="form-check-label">
                                Laki-laki
                            </label>

                        </div>

                        <div class="form-check form-check-inline">

                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="P"
                                @checked(old('jenis_kelamin', $pegawai->jenis_kelamin ?? '') == 'P')>

                            <label class="form-check-label">
                                Perempuan
                            </label>

                        </div>
                        @error('jenis_kelamin')
                            <div class="text-danger small">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label>Agama<span class="text-danger">*</span></label>

                    <select name="agama_id" class="form-control @error('agama_id') is-invalid @enderror">

                        <option value="">-- Pilih Agama --</option>

                        @foreach ($agamas as $agama)
                            <option value="{{ $agama->id }}" @selected(old('agama_id', $pegawai->agama_id ?? '') == $agama->id)>
                                {{ $agama->nama }}
                            </option>
                        @endforeach

                    </select>
                    @error('agama_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- DATA AKADEMIK --}}
{{-- ========================================================= --}}
<div class="card card-info card-outline">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-graduation-cap"></i>
            Data Akademik
        </h3>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-4">

                <div class="form-group">

                    <label>Pendidikan<span class="text-danger">*</span></label>

                    <select name="pendidikan_id" class="form-control @error('pendidikan_id') is-invalid @enderror">

                        <option value="">-- Pilih Pendidikan --</option>

                        @foreach ($pendidikans as $pendidikan)
                            <option value="{{ $pendidikan->id }}" @selected(old('pendidikan_id', $pegawai->pendidikan_id ?? '') == $pendidikan->id)>
                                {{ $pendidikan->nama }}
                            </option>
                        @endforeach

                    </select>

                    @error('pendidikan_id')
                        <div class="text-danger small">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label>Golongan<span class="text-danger">*</span></label>

                    <select name="golongan_id" class="form-control @error('golongan_id') is-invalid @enderror">

                        <option value="">-- Pilih Golongan --</option>

                        @foreach ($golongans as $golongan)
                            <option value="{{ $golongan->id }}" @selected(old('golongan_id', $pegawai->golongan_id ?? '') == $golongan->id)>
                                {{ $golongan->kode }}
                            </option>
                        @endforeach

                    </select>

                    @error('golongan_id')
                        <div class="text-danger small">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">

                    <label>Jabatan Akademik</label>

                    <select name="jabatan_akademik_id"
                        class="form-control @error('jabatan_akademik_id') is-invalid @enderror">

                        <option value="">-- Pilih Jabatan Akademik --</option>

                        @foreach ($jabatanAkademiks as $jabatan)
                            <option value="{{ $jabatan->id }}" @selected(old('jabatan_akademik_id', $pegawai->jabatan_akademik_id ?? '') == $jabatan->id)>
                                {{ $jabatan->nama }}
                            </option>
                        @endforeach

                    </select>

                    @error('jabatan_akademik_id')
                        <div class="text-danger small">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    </div>

</div>


<div class="text-right">

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i>
        Simpan
    </button>

    <a href="{{ route('dosen.index') }}" class="btn btn-secondary">
        Kembali
    </a>

</div>
