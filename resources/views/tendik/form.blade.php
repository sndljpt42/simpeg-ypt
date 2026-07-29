{{-- ========================================================= --}}
{{-- Jenis Pegawai (otomatis Dosen) --}}
{{-- ========================================================= --}}
<input type="hidden" name="jenis_pegawai_id" value="{{ $jenisPegawais->id ?? $pegawai->jenis_pegawai_id }}">


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

            <div class="col-md-6">
                <div class="form-group">
                    <label>NIPY <span class="text-danger">*</span></label>

                    <input type="text" name="nipy" class="form-control @error('nipy') is-invalid @enderror"
                        value="{{ old('nipy', $pegawai->nipy ?? '') }}">

                    @error('nipy')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Status Pegawai<span class="text-danger">*</span></label>

                    <select name="status_pegawai_id"
                        class="form-control @error('status_pegawai_id') is-invalid @enderror">
                        <option value="">-- Pilih Status Pegawai --</option>

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

        <div class="row">

            <div class="col-md-6">
                <div class="form-group">

                    <label>Unit Kerja<span class="text-danger">*</span></label>

                    <select name="unit_kerja_id" class="form-control @error('unit_kerja_id') is-invalid @enderror">

                        <option value="">-- Pilih Unit Kerja --</option>

                        @foreach ($unitKerjas as $unit)
                            <option value="{{ $unit->id }}" @selected(old('unit_kerja_id', $pegawai->unit_kerja_id ?? '') == $unit->id)>
                                {{ $unit->nama }}
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

            <div class="col-md-6">

                <div class="form-group">

                    <label>TMT<span class="text-danger">*</span></label>

                    <input type="date" name="tmt" class="form-control @error('tmt') is-invalid @enderror"
                        value="{{ old('tmt', $pegawai->tmt ?? '') }}">

                    @error('tmt')
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

                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror"
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

                    <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
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

            <div class="col-md-6">

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

            <div class="col-md-6">

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
