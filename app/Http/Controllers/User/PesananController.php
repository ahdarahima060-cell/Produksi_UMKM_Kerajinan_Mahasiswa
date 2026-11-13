<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    // Menampilkan daftar semua pesanan milik user yang login
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
        return view('user.pesanan.index', compact('orders'));
    }
}