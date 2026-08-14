<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use App\Models\JenisPegawai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'jenis_pegawai_id',
        'nama',
        'nipy',
        'nuptk',
        'no_serdos',
        'tanggal_serdos',
        'jenis_dosen',
        'jenis_tendik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama_id',
        'tmt',
        'pendidikan_id',
        'unit_kerja_id',
        'program_studi_id',
        'golongan_id',
        'jabatan_akademik_id',
        'status_pegawai_id',
    ];

    // protected function casts():array
    // {
    //     return[
    //         //tanggal otomatis menjadi objek carbon
    //         'tanggal_lahir' => 'date',
    //         //tmt otomatis menjadi objek carbon
    //         'tmt'=> 'date',
    //         //field tangga sertifikasi dosen
    //         'tanggal_serdos' => 'date',
    //     ];
    // }

    //pegawai memiliki satu agama
    public function agama(): BelongsTo
    {
        return $this->belongsTo(Agama::class);
    }

    //pegawai memiliki satu jenis pegawai

    public function jenisPegawai(): BelongsTo
    {
        return $this->belongsTo(JenisPegawai::class);
    }

    //Pegawai memiliki satu pendidikan.
    public function pendidikan(): BelongsTo
    {
        return $this->belongsTo(Pendidikan::class);
    }

    //pegawai memiliki satu status pegawai.
    public function statusPegawai(): BelongsTo
    {
        return $this->belongsTo(StatusPegawai::class);
    }

    //pegawai berda pada satu unit kerja
    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class);
    }

    // pegawai memiliki satu program studi
    public function programStudi(): BelongsTo
    {
        return $this->belongsTo(ProgramStudi::class);
    }

    //pegawai memiliki satu golongan aktif  
    public function golongan(): BelongsTo
    {
        return $this->belongsTo(Golongan::class);
    }

    //pegawai memiliki satu jabatan akademik
    public function jabatanAkademik(): BelongsTo
    {
        return $this->belongsTo(JabatanAkademik::class);
    }

    //Scope untuk mengambil data pegawai jenis Dosen
    public function scopeDosen(Builder $query): Builder
    {
        return $query->whereHas('jenisPegawai', function (Builder $query) {
            $query->where('nama', JenisPegawai::DOSEN);
        });
    }

    //scope untuk mengalbil data pegawai jenis Tendik.
    public function scopeTendik(Builder $query): Builder
    {
        return $query->whereHas('jenisPegawai', function (Builder $query) {
            $query->where('nama', JenisPegawai::TENDIK);
        });
    }
}
