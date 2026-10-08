<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'nama',
        'deskripsi',
    ];

    //dokumen dimiliki oleh seorang pegawai
    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }

    //dokumen memiliki banyak versi
    public function versions(): HasMany
    {
        return $this->hasMany(DokumenVersion::class)
            ->orderByDesc('version');
    }
}
