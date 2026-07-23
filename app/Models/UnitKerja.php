<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitKerja extends Model
{
    protected $fillable = [
        'nama',
    ];
    
    //unit kerja memiliki banyak pegawai.

    public function pegawais(): HasMany {
        return $this->hasMany(Pegawai::class);
    }
}
