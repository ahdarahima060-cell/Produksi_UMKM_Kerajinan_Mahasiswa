<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    // 1. Menampilkan halaman checkout
    public function index(Request $request)
    {
        $selectedIds = $request->query('items');

        if (empty($selectedIds)) {
            return redirect()->route('user.keranjang.index')->with('error', 'Pilih minimal satu produk untuk di-checkout.');
        }

        $ids = explode(',', $selectedIds);

        $keranjang = DB::table('cart_items')
            ->join('produks', 'cart_items.produk_id', '=', 'produks.id')
            ->where('cart_items.user_id', Auth::id())
            ->whereIn('produks.id', $ids)
            ->select(
                'produks.id as produk_id',
                'produks.nama_produk',
                'produks.harga',
                'produks.gambar',
                'cart_items.jumlah'
            )
            ->get();

        $total_bayar = 0;
        foreach ($keranjang as $item) {
            $total_bayar += $item->harga * $item->jumlah;
        }

        return view('user.checkout.index', compact('keranjang', 'total_bayar', 'selectedIds'));
    }

    // 2. Menyimpan pesanan & Memproses Pembayaran (Mode AJAX/JSON)
    public function simpan_pesanan(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required',
            'no_telepon' => 'required',
            'alamat_pengiriman' => 'required',
            'selected_items' => 'required',
            'metode_pembayaran' => 'required|in:Cashless,COD',
        ]);

        $ids = explode(',', $request->selected_items);

        $keranjang = DB::table('cart_items')
            ->join('produks', 'cart_items.produk_id', '=', 'produks.id')
            ->where('cart_items.user_id', Auth::id())
            ->whereIn('produks.id', $ids)
            ->select('produks.id as produk_id', 'produks.nama_produk', 'produks.harga', 'cart_items.jumlah')
            ->get();

        $total_bayar = 0;
        foreach ($keranjang as $item) {
            $total_bayar += $item->harga * $item->jumlah;
        }

        // Simpan ke tabel orders
        $pesanan_baru = Order::create([
            'user_id' => Auth::id(),
            'nama_penerima' => $request->nama_penerima,
            'no_telepon' => $request->no_telepon,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'total_harga' => $total_bayar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $request->metode_pembayaran === 'COD' ? 'cod' : 'pending',
        ]);

        // Pindahkan ke tabel order_items
        foreach ($keranjang as $item) {
            OrderItem::create([
                'order_id' => $pesanan_baru->id,
                'produksi_id' => $item->produk_id,
                'jumlah_beli' => $item->jumlah,
                'harga_satuan' => $item->harga,
            ]);
        }

        // ================= LOGIKA PEMBAYARAN =================

        // Jika COD
        if ($request->metode_pembayaran === 'COD') {
            // Hapus keranjang karena pesanan sudah dibuat
            DB::table('cart_items')->where('user_id', Auth::id())->whereIn('produk_id', $ids)->delete();

            // Kembalikan respon JSON redirect ke halaman sukses
            return response()->json([
                'status' => 'success',
                'redirect' => route('user.checkout.sukses', $pesanan_baru->id)
            ]);
        }

        // Jika Cashless (Midtrans)
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production'); // Ini harusnya bernilai false
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
        // Hanya untuk pengembangan lokal
        Config::$curlOptions = [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [],
        ];
        // Trik agar tidak error SSL di Localhost
        Config::$curlOptions = [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [],
        ];

        $item_details = [];
        foreach ($keranjang as $item) {
            $item_details[] = [
                'id' => (string) $item->produk_id,
                'price' => (int) $item->harga,
                'quantity' => (int) $item->jumlah,
                'name' => substr($item->nama_produk, 0, 50),
            ];
        }

        $params = [
            'transaction_details' => [
                'order_id' => $pesanan_baru->id . '-' . time(),
                'gross_amount' => (int) $total_bayar,
            ],
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => $request->nama_penerima,
                'phone' => $request->no_telepon,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $pesanan_baru->update(['snap_token' => $snapToken]);

            // JIKA BERHASIL, BARU HAPUS KERANJANG
            DB::table('cart_items')->where('user_id', Auth::id())->whereIn('produk_id', $ids)->delete();

            // Kembalikan respon JSON berisi token untuk popup
            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken,
                'order_id' => $pesanan_baru->id
            ]);
        } catch (\Exception $e) {
            // JIKA GAGAL, BATALKAN PESANAN AGAR TIDAK MASUK DATABASE
            $pesanan_baru->items()->delete();
            $pesanan_baru->delete();

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal terhubung ke Midtrans: ' . $e->getMessage()
            ], 500);
        }
    }

    // 3. Halaman Pesanan Berhasil
    public function sukses($id)
    {
        $order = Order::findOrFail($id);
        return view('user.checkout.sukses', compact('order'));
    }

    // 4. Menangani Webhook (Notifikasi dari Midtrans)
    public function handleWebhook(Request $request)
    {
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $order_id_midtrans = $notif->order_id;
        $fraud = $notif->fraud_status;

        $order_id = explode('-', $order_id_midtrans)[0];
        $order = Order::find($order_id);

        if (!$order) return response()->json(['message' => 'Order not found'], 404);

        if ($transaction == 'capture') {
            if ($fraud == 'challenge') {
                $order->update(['status_pembayaran' => 'challenge']);
            } else if ($fraud == 'accept') {
                $order->update(['status_pembayaran' => 'paid']);
            }
        } else if ($transaction == 'settlement') {
            $order->update(['status_pembayaran' => 'paid']);
        } else if ($transaction == 'pending') {
            $order->update(['status_pembayaran' => 'pending']);
        } else if ($transaction == 'deny' || $transaction == 'cancel') {
            $order->update(['status_pembayaran' => 'failed']);
        } else if ($transaction == 'expire') {
            $order->update(['status_pembayaran' => 'expired']);
        }

        return response()->json(['message' => 'Webhook received']);
    }
}
