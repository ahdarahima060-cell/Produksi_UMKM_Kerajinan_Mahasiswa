<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - Ruang Karya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f7f2; font-family: Arial, sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .card { max-width: 500px; width: 90%; text-align: center; padding: 40px; border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .icon-success { font-size: 80px; color: #28a745; margin-bottom: 20px; }
        .detail-box { background: #f9fbf8; border-radius: 10px; padding: 20px; text-align: left; margin: 20px 0; border: 1px dashed #dbe4d8; }
        .btn-green { background-color: #315b46; color: white; width: 100%; padding: 12px; border-radius: 8px; font-weight: bold; border: none; }
        .btn-green:hover { background-color: #244535; color: white; }
    </style>
</head>
<body>
    <div class="card bg-white">
        <i class="fa-solid fa-circle-check icon-success"></i>
        <h2 class="fw-bold mb-2" style="color: #315b46;">Pesanan Berhasil Dibuat!</h2>
        <p class="text-muted">Terima kasih, pembayaran Anda telah berhasil kami terima.</p>

        <div class="detail-box">
            <p class="mb-2"><strong>Nomor Invoice:</strong> <br>INV-{{ $order->id }}-{{ date('Ymd') }}</p>
            <p class="mb-2"><strong>Total Pembayaran:</strong> <br>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
            <p class="mb-2"><strong>Metode Pembayaran:</strong> <br>{{ $order->metode_pembayaran }}</p>
            <p class="mb-0"><strong>Status Pembayaran:</strong> <br>
                @if($order->status_pembayaran == 'paid' || $order->metode_pembayaran == 'Cashless')
                    <span class="text-success fw-bold"><i class="fa-solid fa-circle-check"></i> Berhasil</span>
                @else
                    <span class="text-warning fw-bold"><i class="fa-solid fa-clock"></i> Menunggu Pembayaran (COD)</span>
                @endif
            </p>
        </div>
        <a href="{{ route('user.dashboard') }}" class="btn btn-green">Lihat Pesanan Saya</a>
    </div>
</body>
</html>
