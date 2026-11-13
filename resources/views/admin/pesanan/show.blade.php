@extends('layouts.admin') {{-- Sesuaikan dengan nama layout admin Anda --}}

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Detail Pesanan #{{ $pesanan->id }}</h2>
        <a href="{{ route('admin.pesanan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">Informasi Pengiriman</h5>
                    <p><strong>Nama:</strong> {{ $pesanan->nama_penerima }}</p>
                    <p><strong>No. Telp:</strong> {{ $pesanan->no_telepon }}</p>
                    <p><strong>Alamat:</strong> {{ $pesanan->alamat_pengiriman }}</p>
                    <hr>
                    <p><strong>Metode Pembayaran:</strong> {{ $pesanan->metode_pembayaran }}</p>
                    <p><strong>Status:</strong> 
                        @if($pesanan->status_pembayaran == 'paid')
                            <span class="badge bg-success">Lunas</span>
                        @elseif($pesanan->status_pembayaran == 'cod')
                            <span class="badge bg-info text-dark">COD</span>
                        @else
                            <span class="badge bg-warning text-dark">{{ $pesanan->status_pembayaran }}</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">Rincian Barang</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($pesanan->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h6 class="mb-0">{{ $item->produksi->produk->nama ?? 'Produk' }}</h6>
                                <small class="text-muted">{{ $item->jumlah_beli }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</small>
                            </div>
                            <span class="font-weight-bold">Rp {{ number_format($item->jumlah_beli * $item->harga_satuan, 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    </ul>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <h5 class="mb-0">Total Belanja</h5>
                        <h4 class="mb-0 text-success">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection