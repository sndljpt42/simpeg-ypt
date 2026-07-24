<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisPegawai extends Model
{

    public const DOSEN = 'Dosen';
    public const TENDIK = 'Tendik';

    
    protected $fillable = [
        'nama',
    ];

    //jenis pegawai memiliki banyak pegawai
    public function pegawais(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }
}
