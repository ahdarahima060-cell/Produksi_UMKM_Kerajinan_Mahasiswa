<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nama_penerima', 'no_telepon', 'alamat_pengiriman', 
        'total_harga', 'metode_pembayaran', 'status_pembayaran', 'snap_token'
    ];

    // Relasi ke User (Pembeli)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Item Barang yang dibeli
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}