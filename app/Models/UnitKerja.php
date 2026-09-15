<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitKerja extends Model
{
    protected $fillable = [
        'nama',
        'parent_id'
    ];

    //unit ker memiliki satu unit kerja induk

    public function parent(): BelongsTo {
        return $this->belongsTo(UnitKerja::class, 'parent_id');
    }

    //unit kerja dapat memiliki banyak unit kerja turunannya

    public function children(): HasMany{
        return $this->hasMany(UnitKerja::class, 'parent_id');
    }

    //unit kerja memiliki banyak pegawai.

    public function pegawais(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }

    //unit kerja memiliki banyak prodi

    public function programStudis(): HasMany
    {
        return $this->hasMany(ProgramStudi::class);
    }
}
