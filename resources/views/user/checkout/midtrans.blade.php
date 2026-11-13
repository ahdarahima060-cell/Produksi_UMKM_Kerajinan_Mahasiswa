<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Ruang Karya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- WAJIB: Script Midtrans Snap -->
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>

    <style>
        body {
            background-color: #f5f7f2;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .payment-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            box-shadow: 0 10px 30px rgba(36, 69, 53, 0.08);
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            background: #eaf0e6;
            color: #315b46;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            margin: 0 auto 20px;
        }

        h2 {
            color: #244535;
            font-weight: 700;
            margin-bottom: 10px;
        }

        p {
            color: #7b857d;
            font-size: 14px;
            line-height: 1.6;
        }

        .order-details {
            background: #f9fbf8;
            border: 1px dashed #dbe4d8;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
        }

        .order-details .label {
            font-size: 13px;
            color: #7b857d;
            margin-bottom: 5px;
        }

        .order-details .amount {
            font-size: 24px;
            font-weight: 700;
            color: #315b46;
        }

        .btn-pay {
            background-color: #315b46;
            color: white;
            border: none;
            padding: 14px 20px;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            font-size: 16px;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-pay:hover {
            background-color: #244535;
        }

        .btn-back {
            display: inline-block;
            margin-top: 15px;
            color: #7b857d;
            text-decoration: none;
            font-size: 13px;
        }

        .btn-back:hover {
            color: #315b46;
        }
    </style>
</head>
<body>

    <div class="payment-card">
        <div class="icon-wrapper">
            <i class="fa-solid fa-wallet"></i>
        </div>
        
        <h2>Menyelesaikan Pembayaran</h2>
        <p>Jendela pembayaran Midtrans akan terbuka secara otomatis.<br>Jika tidak, silakan klik tombol di bawah ini.</p>

        <div class="order-details">
            <div class="label">Total Tagihan</div>
            <div class="amount">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
            <div class="label mt-2" style="font-size: 11px;">Order ID: #{{ $order->id }}</div>
        </div>

        <button id="pay-button" class="btn-pay">
            <i class="fa-solid fa-credit-card"></i> Buka Pembayaran
        </button>

        <a href="{{ route('user.dashboard') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        var snapToken = "{{ $order->snap_token }}";

        function openSnap() {
            window.snap.pay(snapToken, {
                onSuccess: function(result){
                    // Pembayaran berhasil, alihkan ke dashboard dengan status sukses
                    window.location.href = "{{ route('user.dashboard') }}?status=success";
                },
                onPending: function(result){
                    // Menunggu pembayaran
                    window.location.href = "{{ route('user.dashboard') }}?status=pending";
                },
                onError: function(result){
                    alert("Pembayaran gagal! Silakan coba lagi.");
                },
                onClose: function(){
                    console.log('User menutup popup tanpa menyelesaikan pembayaran.');
                }
            });
        }

        // Buka popup otomatis saat halaman dimuat
        openSnap();
        
        // Tombol manual jika popup gagal terbuka
        payButton.onclick = function(){ openSnap(); };
    </script>

</body>
</html>