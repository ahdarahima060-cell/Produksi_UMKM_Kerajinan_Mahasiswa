<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // Menampilkan daftar semua pesanan
    public function index()
    {
        // Ambil pesanan terbaru, urutkan dari yang paling baru
        $pesanan = Order::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pesanan.index', compact('pesanan'));
    }

    // Menampilkan detail satu pesanan
    public function show($id)
    {
        $pesanan = Order::with(['user', 'items'])->findOrFail($id);
        return view('admin.pesanan.show', compact('pesanan'));
    }
}