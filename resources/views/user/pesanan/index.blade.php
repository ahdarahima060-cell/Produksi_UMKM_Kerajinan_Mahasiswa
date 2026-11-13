<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Ruang Karya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --green: #315b46;
            --green-light: #eaf0e6;
            --page: #f5f7f2;
        }
        body {
            background: var(--page);
            font-family: Arial, sans-serif;
        }
        .topbar {
            background: #fff; padding: 15px 5%; border-bottom: 1px solid #e5e9e1;
            display: flex; justify-content: space-between; align-items: center;
        }
        .brand { color: var(--green); font-weight: bold; font-size: 20px; text-decoration: none; display: flex; align-items: center; gap: 10px; }
        .container { margin-top: 40px; max-width: 900px; }
        .card-order {
            background: white; border-radius: 12px; border: 1px solid #e5e9e1;
            padding: 20px; margin-bottom: 20px;
        }
        .badge-status { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .bg-pending { background: #fff3cd; color: #856404; }
        .bg-paid { background: #d4edda; color: #155724; }
        .bg-cod { background: #cce5ff; color: #004085; }
        .bg-failed { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>

    <header class="topbar">
        <a href="{{ route('user.dashboard') }}" class="brand">
            <i class="fa-solid fa-leaf"></i> Ruang Karya
        </a>
        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary btn-sm">Kembali Belanja</a>
    </header>

    <div class="container">
        <h2 class="fw-bold mb-4" style="color: var(--green);">Pesanan Saya</h2>

        @forelse($orders as $order)
            <div class="card-order shadow-sm">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                    <div>
                        <span class="text-muted small">Nomor Invoice</span>
                        <h5 class="mb-0 fw-bold">INV-{{ $order->id }}-{{ $order->created_at->format('Ymd') }}</h5>
                    </div>
                    <div>
                        @if($order->status_pembayaran == 'paid')
                            <span class="badge-status bg-paid"><i class="fa-solid fa-check-circle"></i> Lunas</span>
                        @elseif($order->status_pembayaran == 'cod')
                            <span class="badge-status bg-cod"><i class="fa-solid fa-money-bill-wave"></i> COD</span>
                        @elseif($order->status_pembayaran == 'pending')
                            <span class="badge-status bg-pending"><i class="fa-solid fa-clock"></i> Pending</span>
                        @else
                            <span class="badge-status bg-failed"><i class="fa-solid fa-times-circle"></i> Gagal</span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1 text-muted small">Total Pembayaran</p>
                        <h4 class="fw-bold text-success mb-3">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</h4>
                        <p class="mb-1 text-muted small">Metode Pembayaran</p>
                        <p class="fw-bold">{{ $order->metode_pembayaran }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 text-muted small">Alamat Pengiriman</p>
                        <p class="mb-1"><strong>{{ $order->nama_penerima }}</strong> ({{ $order->no_telepon }})</p>
                        <p class="text-muted small">{{ $order->alamat_pengiriman }}</p>
                        <p class="mb-0 text-muted small mt-2">Tanggal: {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5 bg-white rounded border">
                <i class="fa-solid fa-box-open mb-3" style="font-size: 40px; color: #ccc;"></i>
                <h5 class="text-muted">Belum ada pesanan.</h5>
                <a href="{{ route('user.dashboard') }}" class="btn btn-success mt-3" style="background-color: var(--green);">Mulai Belanja</a>
            </div>
        @endforelse
    </div>

</body>
</html>