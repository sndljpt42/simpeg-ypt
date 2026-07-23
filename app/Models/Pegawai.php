<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pegawai extends Model
{
    protected $fillable = [
        'nipy',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',

        'agama_id',
        'pendidikan_id',
        'jenis_pegawai_id',
        'status_pegawai_id',
        'unit_kerja_id',
        'golongan_id',
        'jabatan_akademik_id',

        'tmt',
    ];

    //pegawai memiliki satu agama
    public function agama(): BelongsTo {
        return $this->belongsTo(Agama::class);
    }

    //pegawai memiliki satu jenis pegawai

    public function jenisPegawai(): BelongsTo {
        return $this->belongsTo(JenisPegawai::class);
    }

    //pegawai memiliki satu status pegawai.
    public function statusPegawai(): BelongsTo {
        return $this->belongsTo(StatusPegawai::class);
    }

    //pegawai berda pada satu unit kerja
    public function unitKerja(): BelongsTo {
        return $this->belongsTo(UnitKerja::class);
    }

    //pegawai memiliki satu golongan aktif  
    public function golongan(): BelongsTo {
        return $this->belongsTo(Golongan::class);
    }

    //pegawai memiliki satu jabatan akademik
    public function jabatanAkademik(): BelongsTo {
        return $this->belongsTo(JabatanAkademik::class);
    }
}
