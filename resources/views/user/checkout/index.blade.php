<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Ruang Karya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --green: #315b46;
            --green-dark: #244535;
            --green-light: #eaf0e6;
            --page: #f5f7f2;
            --line: #e5e9e1;
            --text: #26382d;
            --muted: #7b857d;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--page);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        .topbar {
            width: 100%;
            min-height: 76px;
            padding: 0 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: #fff;
            border-bottom: 1px solid var(--line);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
            color: var(--green);
            font-size: 23px;
            font-weight: 700;
            text-decoration: none;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            color: white;
            background: var(--green);
            border-radius: 12px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 17px;
            border: 1px solid #dbe4d8;
            border-radius: 9px;
            background: white;
            color: var(--green);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: .2s;
        }

        .back-link:hover {
            background: var(--green-light);
            color: var(--green-dark);
        }

        .page {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 36px 5% 60px;
        }

        .page-heading {
            margin-bottom: 28px;
        }

        .heading-title {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .heading-icon {
            width: 54px;
            height: 54px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 15px;
            background: var(--green-light);
            color: var(--green);
            font-size: 22px;
        }

        .page-heading h1 {
            margin: 0 0 6px;
            color: var(--green);
            font-size: 28px;
            font-weight: 700;
        }

        .page-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 15px;
        }

        .checkout-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 360px;
            align-items: start;
            gap: 24px;
        }

        .form-card, .summary-card {
            background: white;
            border: 1px solid var(--line);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 3px 12px rgba(36, 69, 53, .045);
        }

        .summary-card {
            position: sticky;
            top: 24px;
        }

        .section-title {
            margin: 0 0 20px;
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 6px;
        }

        .form-control {
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .form-control:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 0.2rem rgba(49, 91, 70, 0.25);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
            color: var(--muted);
            font-size: 14px;
        }

        .summary-divider {
            border: 0;
            border-top: 1px solid var(--line);
            margin: 20px 0;
        }

        .total-label {
            color: var(--text);
            font-size: 14px;
            font-weight: 600;
        }

        .total-price {
            margin-top: 7px;
            color: var(--green);
            font-size: 26px;
            font-weight: 700;
        }

        .btn-green {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            width: 100%;
            min-height: 46px;
            padding: 12px 16px;
            border: 0;
            border-radius: 9px;
            background: var(--green);
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: .2s;
            margin-top: 15px;
        }

        .btn-green:hover {
            background: var(--green-dark);
            color: white;
        }
        
        .btn-green:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        @media (max-width: 900px) {
            .checkout-layout {
                grid-template-columns: minmax(0, 1fr);
            }
            .summary-card {
                position: static;
            }
        }
    </style>
</head>
<body>

<header class="topbar">
    <a href="{{ route('user.dashboard') }}" class="brand">
        <span class="brand-icon">
            <i class="fa-solid fa-leaf"></i>
        </span>
        <span>Ruang Karya</span>
    </a>

    <a href="{{ route('user.keranjang.index') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Keranjang
    </a>
</header>

<main class="page">
    <div class="page-heading">
        <div class="heading-title">
            <div class="heading-icon">
                <i class="fa-solid fa-money-check-dollar"></i>
            </div>
            <div>
                <h1>Checkout Pesanan</h1>
                <p>Lengkapi data pengiriman untuk menyelesaikan pesanan Anda.</p>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
    @endif

    <!-- FORM DIMULAI DI SINI DENGAN ID checkoutForm -->
    <form id="checkoutForm" action="{{ route('user.checkout.store') }}" method="POST">
        @csrf
        <input type="hidden" name="selected_items" value="{{ request('items') }}">
        
        <div class="checkout-layout">
            
            <!-- KOLOM KIRI: FORM -->
            <section class="form-card">
                <h2 class="section-title">Informasi Pengiriman</h2>
                
                <label class="form-label">Nama Penerima</label>
                <input type="text" name="nama_penerima" class="form-control" value="{{ old('nama_penerima', Auth::user()->name) }}" required placeholder="Masukkan nama lengkap">

                <label class="form-label">No. Telepon / WhatsApp</label>
                <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon') }}" required placeholder="08xxxxxxxxxx">

                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat_pengiriman" class="form-control" rows="4" required placeholder="Tuliskan nama jalan, RT/RW, kelurahan, kecamatan, kota, dan kode pos">{{ old('alamat_pengiriman') }}</textarea>

                <h2 class="section-title mt-4">Metode Pembayaran</h2>
                
                <div class="d-flex flex-column gap-3">
                    <!-- Opsi 1: Cashless -->
                    <label class="d-flex align-items-center gap-3 p-3 border rounded" style="cursor: pointer; background: white;">
                        <input type="radio" name="metode_pembayaran" value="Cashless" checked style="width: 18px; height: 18px;">
                        <div>
                            <strong style="display: block; color: var(--text);"><i class="fa-solid fa-wallet me-2"></i> Cashless (E-Wallet / Transfer)</strong>
                            <small style="color: var(--muted);">Bayar melalui Transfer Bank, QRIS, Dana, OVO, dll.</small>
                        </div>
                    </label>

                    <!-- Opsi 2: COD -->
                    <label class="d-flex align-items-center gap-3 p-3 border rounded" style="cursor: pointer; background: white;">
                        <input type="radio" name="metode_pembayaran" value="COD" style="width: 18px; height: 18px;">
                        <div>
                            <strong style="display: block; color: var(--text);"><i class="fa-solid fa-money-bill-wave me-2"></i> Cash (COD / Bayar di Tempat)</strong>
                            <small style="color: var(--muted);">Bayar langsung secara tunai saat barang diterima.</small>
                        </div>
                    </label>
                </div>
            </section>

            <!-- KOLOM KANAN: RINGKASAN -->
            <aside class="summary-card">
                <h2 class="section-title">
                    <i class="fa-solid fa-receipt me-2" style="color: var(--green);"></i>
                    Ringkasan Pesanan
                </h2>

                <!-- Looping Barang (Kode Dobel Sudah Dihapus) -->
                <div style="max-height: 200px; overflow-y: auto; margin-bottom: 15px;">
                    @foreach($keranjang as $item)
                    <div class="summary-row" style="margin-bottom: 10px;">
                        <div>
                            <span style="color: var(--text); font-weight: 600;">
                                {{ $item->nama_produk }}
                            </span>
                            <br>
                            <small style="font-size: 12px;">{{ $item->jumlah }} x Rp {{ number_format($item->harga, 0, ',', '.') }}</small>
                        </div>
                        <span style="color: var(--text); font-weight: 600;">
                            Rp {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}
                        </span>
                    </div>
                    @endforeach
                </div>

                <hr class="summary-divider">

                <div class="total-label">Total Belanja</div>
                <div class="total-price">
                    Rp {{ number_format($total_bayar, 0, ',', '.') }}
                </div>

                <button type="submit" class="btn-green" id="btnCheckout">
                    <i class="fa-solid fa-check"></i>
                    Buat Pesanan
                </button>
            </aside>
        </div>
    </form>
</main>

<!-- SCRIPT MIDTRANS & AJAX DITAMBAHKAN DI SINI -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah halaman reload (pindah halaman)

        let form = this;
        let formData = new FormData(form);
        let btn = document.getElementById('btnCheckout');
        
        // Ubah tampilan tombol menjadi loading
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';

        // Kirim data form ke Controller via AJAX
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                Swal.fire('Gagal', data.message, 'error');
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-check"></i> Buat Pesanan';
                return;
            }

            // Jika pembayaran Cashless (Midtrans)
            if (data.snap_token) {
                window.snap.pay(data.snap_token, {
                    onSuccess: function(result){
                        // Jika sukses, arahkan ke halaman sukses
                        window.location.href = "{{ url('/user/checkout/sukses') }}/" + data.order_id;
                    },
                    onPending: function(result){
                        // Jika pending (misal belum bayar), tetap arahkan ke halaman sukses
                        window.location.href = "{{ url('/user/checkout/sukses') }}/" + data.order_id;
                    },
                    onError: function(result){
                        Swal.fire('Gagal', 'Pembayaran gagal! Silakan coba lagi.', 'error');
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fa-solid fa-check"></i> Buat Pesanan';
                    },
                    onClose: function(){
                        // Jika user menutup popup tanpa bayar, biarkan tombol bisa diklik lagi
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fa-solid fa-check"></i> Buat Pesanan';
                    }
                });
            } 
            // Jika pembayaran COD
            else if (data.redirect) {
                window.location.href = data.redirect;
            }
        })
        .catch(error => {
            Swal.fire('Error', 'Terjadi kesalahan sistem.', 'error');
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-check"></i> Buat Pesanan';
        });
    });
</script>

</body>
</html>