<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JabatanAkademik extends Model
{
    protected $fillable = [
        'nama',
        'golongan_min_id',
        'golongan_max_id',
        'usia_pensiun',
        'maks_kgb_setelah-mentok',
    ];

    //golongan minimal jabatan akademik

    public function golonganMin(): BelongsTo {
        return $this->belongsTo(Golongan::class, 'golongan_min_id');

    }

    //golongan maksimal jabatan akademik
    public function golonganMax(): BelongsTo {
        return $this->belongsTo(Golongan::class, 'golongan_max_id');
    }

    //satu jabatan akademik dimiliki banyak dosen 
    public function dosens(): HasMany {
        return $this->hasMany(Pegawai::class);
    }
}
