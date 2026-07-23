<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusPegawai extends Model
{
    protected $fillable = [
        'nama',
    ];

    //status pegawai digunakan oleh banyak pegawai
    public function pegawais(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }
}
