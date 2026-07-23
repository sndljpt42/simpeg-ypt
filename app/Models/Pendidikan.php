<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendidikan extends Model
{
    protected $fillable = [
        'nama',
    ];

    //satu pendidikan dimiliki banyak pegawai

    public function pegawais(): HasMany{
        return $this->hasMany(Pegawai::class);
    }
}
