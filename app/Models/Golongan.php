<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Golongan extends Model
{
    protected $fillable = [
        'nama',
    ];

    //banyak pegawai berada pada golongan ini

    public function pegawais(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }

    //golongan sebagai batas minimal jabatan akademik

    public function jabatanAkademikMin(): HasMany {
        return $this->hasMany(JabatanAkademik::class, 'golongan_min_id');
    
    }

    //golongan sebagai batas maksimal jabatan akademik

    public function jabatanAkademikMax(): HasMany {
        return $this->hasMany(JabatanAkademik::class, 'golongan_max_id');
    }
}
