<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumenVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokumen_id',
        'version',
        'nama_file',
        'path',
        'mime_type',
        'ukuran',
        'checksum',
    ];

    //version dimiliki oleh sebuah dokumen
    public function dokumen(): BelongsTo
    {
        return $this->belongsTo(Dokumen::class);
    }
}
