<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'user_id',
        'produksi_id', // Pastikan nama kolom di tabel cart_items Anda benar ini
        'quantity',
    ];

    // Relasi ke tabel Produksi
    public function produksi()
    {
        return $this->belongsTo(Produksi::class, 'produksi_id');
    }
}