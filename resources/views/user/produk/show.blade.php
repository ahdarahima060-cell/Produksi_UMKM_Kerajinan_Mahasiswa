```blade
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary mb-4">
        ← Kembali
    </a>

    <div class="row g-4">
        <div class="col-md-5">
            @if ($produk->gambar)
                <img
                    src="{{ asset('storage/' . $produk->gambar) }}"
                    alt="{{ $produk->nama_produk }}"
                    class="img-fluid rounded shadow-sm w-100"
                >
            @else
                <div class="bg-light rounded p-5 text-center">
                    Foto produk belum tersedia.
                </div>
            @endif
        </div>

        <div class="col-md-7">
            <h2>{{ $produk->nama_produk }}</h2>

            <p class="text-muted">
                Kategori: {{ $produk->kategori }}
            </p>

            <h3 class="my-3 text-success">
                Rp {{ number_format($produk->harga, 0, ',', '.') }}
            </h3>

            <p>
                <strong>Stok:</strong> {{ $produk->stok }} unit
            </p>

            <hr>

            <h5>Deskripsi Produk</h5>
            <p>{{ $produk->deskripsi ?: 'Belum ada deskripsi produk.' }}</p>
        </div>
    </div>
</div>
@endsection
```