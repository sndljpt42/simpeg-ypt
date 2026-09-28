<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatJabatanAkademik extends Model
{
    use HasFactory;

    // field yang boleh diisi
    protected $fillable = [
        'pegawai_id',
        'jabatan_akademik_id',
        'nomor_sk',
        'tanggal_sk',
        'tmt',
        'keterangan',
    ];

    // mengubah field tanggal jadi object Carbon
    protected function casts(): array
    {
        return [
            'tanggal_sk' => 'date',
            'tmt' => 'date',
        ];
    }

    // riwayat jabatan akademik dimiliki oleh satu pegawai
    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }

    // riwayat jabatan akademik menggunakan satu data jabatan akademik
    public function jabatanAkademik(): BelongsTo
    {
        return $this->belongsTo(JabatanAkademik::class);
    }
}
