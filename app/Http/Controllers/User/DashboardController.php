<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Produk::latest()->get();

        return view('user.dashboard', compact('products'));
    }

    public function showProduk(Produk $produk)
    {
        return view('user.produk.show', compact('produk'));
    }
}
