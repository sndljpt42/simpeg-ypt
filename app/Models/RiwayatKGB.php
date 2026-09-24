<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatKGB extends Model
{
    use HasFactory;

    protected $table = 'riwayat_kgb';

    protected $fillable = [
        'pegawai_id',
        'nomor_sk',
        'tanggal_sk',
        'tmt',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_sk' => 'date',
        'tmt' => 'date',
    ];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }
}
