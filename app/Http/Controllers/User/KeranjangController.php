<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = DB::table('cart_items')
            ->join('produks', 'cart_items.produk_id', '=', 'produks.id')
            ->where('cart_items.user_id', auth()->id())
            ->select(
                'produks.id as produk_id',
                'produks.nama_produk',
                'produks.harga',
                'produks.gambar',
                'cart_items.jumlah'
            )
            ->get()
            ->map(function ($item) {
                return [
                    'produk_id' => $item->produk_id,
                    'nama_produk' => $item->nama_produk,
                    'harga' => $item->harga,
                    'gambar' => $item->gambar,
                    'jumlah' => $item->jumlah,
                ];
            })
            ->keyBy('produk_id')
            ->toArray();

        return view('user.keranjang.index', compact('keranjang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $jumlah = (int) $request->jumlah;
        $userId = auth()->id();

        $itemLama = DB::table('cart_items')
            ->where('user_id', $userId)
            ->where('produk_id', $produk->id)
            ->first();

        $jumlahBaru = ($itemLama->jumlah ?? 0) + $jumlah;

        if ($jumlahBaru > $produk->stok) {
            return back()->with(
                'error',
                'Jumlah melebihi stok yang tersedia.'
            );
        }

        DB::table('cart_items')->updateOrInsert(
            [
                'user_id' => $userId,
                'produk_id' => $produk->id,
            ],
            [
                'jumlah' => $jumlahBaru,
                'updated_at' => now(),
                'created_at' => $itemLama->created_at ?? now(),
            ]
        );

        return redirect()
            ->route('user.keranjang.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
}
