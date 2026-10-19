<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Produksi;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    // Menampilkan daftar produksi
    public function index()
    {
        $produksis = Produksi::with('produk')
            ->latest()
            ->get();

        return view('admin.produksi.index', compact('produksis'));
    }

    // Menampilkan form tambah produksi
    public function create()
    {
        $produks = Produk::orderBy('nama_produk')->get();

        return view('admin.produksi.create', compact('produks'));
    }

    // Menyimpan data produksi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah_produksi' => 'required|integer|min:1',
            'tanggal_produksi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Produksi::create($validated);

        return redirect()
            ->route('admin.produksi.index')
            ->with('success', 'Data produksi berhasil ditambahkan.');
    }

    // Melihat detail produksi
    public function show(Produksi $produksi)
    {
        $produksi->load('produk');

        return view('admin.produksi.show', compact('produksi'));
    }

    // Menampilkan form edit
    public function edit(Produksi $produksi)
    {
        $produks = Produk::orderBy('nama_produk')->get();

        return view('admin.produksi.edit', compact('produksi', 'produks'));
    }

    // Memperbarui data produksi
    public function update(Request $request, Produksi $produksi)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah_produksi' => 'required|integer|min:1',
            'tanggal_produksi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $produksi->update($validated);

        return redirect()
            ->route('admin.produksi.index')
            ->with('success', 'Data produksi berhasil diperbarui.');
    }

    // Menghapus data produksi
    public function destroy(Produksi $produksi)
    {
        $produksi->delete();

        return redirect()
            ->route('admin.produksi.index')
            ->with('success', 'Data produksi berhasil dihapus.');
    }
}
