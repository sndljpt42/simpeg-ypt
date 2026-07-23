<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agama extends Model
{
    protected $fillable = [
        'nama',
    ];

    //satu agama dimiliki banyak pegawai

    public function pegawais(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }
}
