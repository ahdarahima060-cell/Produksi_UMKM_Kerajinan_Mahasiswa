<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // 1. Menampilkan halaman checkout
    public function index(Request $request)
    {
        // Ambil ID dari URL (misal: "1,2")
        $selectedIds = $request->query('items');

        if (empty($selectedIds)) {
            return redirect()->route('user.keranjang.index')->with('error', 'Pilih minimal satu produk untuk di-checkout.');
        }

        $ids = explode(',', $selectedIds);

        // Ambil data HANYA untuk produk yang dicentang
        $keranjang = DB::table('cart_items')
            ->join('produks', 'cart_items.produk_id', '=', 'produks.id')
            ->where('cart_items.user_id', Auth::id())
            ->whereIn('produks.id', $ids) // Filter berdasarkan pilihan user
            ->select(
                'produks.id as produk_id',
                'produks.nama_produk',
                'produks.harga',
                'produks.gambar',
                'cart_items.jumlah'
            )
            ->get();

        $total_bayar = 0;
        foreach($keranjang as $item) {
            $total_bayar += $item->harga * $item->jumlah; 
        }

        return view('user.checkout.index', compact('keranjang', 'total_bayar', 'selectedIds'));
    }

    // 2. Menyimpan pesanan
    public function simpan_pesanan(Request $request)
    {
        // TAMBAHAN: Validasi metode_pembayaran
        $request->validate([
            'nama_penerima' => 'required',
            'no_telepon' => 'required',
            'alamat_pengiriman' => 'required',
            'selected_items' => 'required',
            'metode_pembayaran' => 'required|in:Cashless,COD', // Pastikan hanya menerima Cashless atau COD
        ]);

        $ids = explode(',', $request->selected_items);

        $keranjang = DB::table('cart_items')
            ->join('produks', 'cart_items.produk_id', '=', 'produks.id')
            ->where('cart_items.user_id', Auth::id())
            ->whereIn('produks.id', $ids)
            ->select('produks.id as produk_id', 'produks.harga', 'cart_items.jumlah')
            ->get();
        
        $total_bayar = 0;
        foreach($keranjang as $item) {
            $total_bayar += $item->harga * $item->jumlah;
        }

        // Simpan ke tabel orders
        $pesanan_baru = Order::create([
            'user_id' => Auth::id(),
            'nama_penerima' => $request->nama_penerima,
            'no_telepon' => $request->no_telepon,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'total_harga' => $total_bayar,
            'metode_pembayaran' => $request->metode_pembayaran, // TAMBAHAN: Simpan metode pembayaran
        ]);

        // Pindahkan ke tabel order_items
        foreach($keranjang as $item) {
            OrderItem::create([
                'order_id' => $pesanan_baru->id,
                'produksi_id' => $item->produk_id, // Sesuaikan jika nama kolom di tabel order_items Anda adalah produk_id
                'jumlah_beli' => $item->jumlah,
                'harga_satuan' => $item->harga,
            ]);
        }

        // HAPUS HANYA BARANG YANG DICENTANG dari keranjang
        DB::table('cart_items')
            ->where('user_id', Auth::id())
            ->whereIn('produk_id', $ids) 
            ->delete();

        return redirect()->route('user.dashboard')->with('sukses', 'Pesanan berhasil dibuat!');
    }
}