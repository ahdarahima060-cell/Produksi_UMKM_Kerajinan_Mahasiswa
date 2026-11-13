@extends('layouts.admin') {{-- Sesuaikan dengan nama layout admin Anda, misal layouts.admin --}}

@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4">Daftar Pesanan Masuk</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Pembeli</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanan as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                        <td>{{ $item->nama_penerima }}</td>
                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $item->metode_pembayaran }}</td>
                        <td>
                            @if($item->status_pembayaran == 'paid')
                                <span class="badge bg-success">Lunas</span>
                            @elseif($item->status_pembayaran == 'cod')
                                <span class="badge bg-info text-dark">COD</span>
                            @elseif($item->status_pembayaran == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-danger">{{ $item->status_pembayaran }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.pesanan.show', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Belum ada pesanan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $pesanan->links() }}
    </div>
</div>
@endsection