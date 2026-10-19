<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produksi extends Model
{
    protected $table = 'produksi';

    protected $fillable = [
        'produk_id',
        'jumlah_produksi',
        'tanggal_produksi',
        'keterangan',
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}