<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatGolongan extends Model
{
    use HasFactory;

    //field yang boleh diisi
    protected $fillable = [
        'pegawai_id',
        'golongan_id',
        'nomor_sk',
        'tanggal_sk',
        'tmt',
        'keterangan',
    ];

    //mengubah field tanggal jadi object carbon ( $riwayat->tmt->format('d-m-Y'))
    protected function casts(): array
    {
        return [
            'tanggal_sk' => 'date',
            'tmt' => 'date',
        ];
    }

    //riwayt golongan dimiliki oleh satu pegawai
    public function pegawai(): BelongsTo
    {
        return $this-> belongsTo(Pegawai::class);
    }

    //riwayt golongan menggunakan satu data golongan
    public function golongan(): BelongsTo
    {
        return $this->belongsTo(Golongan::class);
    }
}
