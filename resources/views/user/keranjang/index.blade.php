
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Ruang Karya</title>
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

        * {
            box-sizing: border-box;
        }

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
            max-width: 1600px;
            margin: 0 auto;
            padding: 36px 5% 60px;
        }

        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
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
            font-size: clamp(25px, 3vw, 34px);
            font-weight: 700;
        }

        .page-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 15px;
        }

        .cart-count {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 13px;
            border-radius: 30px;
            background: var(--green-light);
            color: var(--green);
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .cart-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            align-items: start;
            gap: 24px;
        }

        .section-label {
            margin: 0 0 14px;
            font-size: 17px;
            font-weight: 700;
            color: var(--text);
        }

        .product-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .product-card,
        .summary-card,
        .empty-card {
            background: white;
            border: 1px solid var(--line);
            border-radius: 15px;
            box-shadow: 0 3px 12px rgba(36, 69, 53, .045);
        }

        .product-card {
            display: flex;
            align-items: center;
            gap: 22px;
            padding: 20px;
            min-width: 0;
        }

        .product-image {
            width: 135px;
            height: 135px;
            flex: 0 0 135px;
            object-fit: cover;
            border-radius: 12px;
            background: var(--page);
        }

        .image-placeholder {
            display: grid;
            place-items: center;
            color: #9aa79a;
            font-size: 30px;
        }

        .product-info {
            flex: 1;
            min-width: 0;
        }

        .product-category {
            margin-bottom: 6px;
            color: var(--muted);
            font-size: 12px;
        }

        .product-name {
            margin: 0 0 10px;
            color: var(--green-dark);
            font-size: 19px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .product-price {
            margin-bottom: 12px;
            color: var(--green);
            font-size: 16px;
            font-weight: 600;
        }

        .quantity-info {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 11px;
            background: #f4f6f1;
            border-radius: 8px;
            color: #5d6a60;
            font-size: 13px;
        }

        .subtotal {
            margin-top: 12px;
            color: var(--text);
            font-size: 14px;
        }

        .subtotal strong {
            color: var(--green);
            font-size: 16px;
        }

        .summary-card {
            position: sticky;
            top: 24px;
            padding: 25px;
        }

        .summary-title {
            margin: 0 0 22px;
            font-size: 19px;
            font-weight: 700;
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
            font-size: clamp(24px, 2vw, 30px);
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .summary-note {
            margin: 12px 0 20px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
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
        }

        .btn-green:hover {
            background: var(--green-dark);
            color: white;
            transform: translateY(-1px);
        }

        .empty-card {
            padding: 65px 25px;
            text-align: center;
        }

        .empty-icon {
            width: 85px;
            height: 85px;
            display: grid;
            place-items: center;
            margin: 0 auto 22px;
            border-radius: 50%;
            background: var(--green-light);
            color: var(--green);
            font-size: 34px;
        }

        .empty-card h2 {
            margin-bottom: 10px;
            color: var(--green-dark);
            font-size: 23px;
            font-weight: 700;
        }

        .empty-card p {
            margin-bottom: 25px;
            color: var(--muted);
        }

        .empty-card .btn-green {
            width: auto;
            min-width: 190px;
        }

        .alert {
            border-radius: 10px;
        }

        @media (max-width: 900px) {
            .cart-layout {
                grid-template-columns: minmax(0, 1fr);
            }

            .summary-card {
                position: static;
            }
        }

        @media (max-width: 600px) {
            .topbar {
                min-height: 68px;
                padding: 12px 5%;
            }

            .brand {
                gap: 9px;
                font-size: 16px;
            }

            .brand-icon {
                width: 36px;
                height: 36px;
            }

            .back-link {
                padding: 9px 10px;
                font-size: 12px;
            }

            .page {
                padding: 25px 4% 40px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
                margin-bottom: 22px;
            }

            .product-card {
                align-items: flex-start;
                gap: 13px;
                padding: 13px;
            }

            .product-image {
                width: 95px;
                height: 105px;
                flex-basis: 95px;
            }

            .product-name {
                font-size: 15px;
            }

            .product-price {
                font-size: 14px;
            }

            .subtotal strong {
                font-size: 14px;
            }

            .summary-card {
                padding: 20px;
            }

            .empty-card {
                padding: 45px 18px;
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

    <a href="{{ route('user.dashboard') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali Belanja
    </a>
</header>

<main class="page">
    <div class="page-heading">
        <div class="heading-title">
            <div class="heading-icon">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div>
                <h1>Keranjang Belanja</h1>
                <p>Periksa kembali produk pilihanmu sebelum melanjutkan.</p>
            </div>
        </div>

        @if (count($keranjang) > 0)
            <span class="cart-count">
                <i class="fa-solid fa-bag-shopping"></i>
                {{ collect($keranjang)->sum('jumlah') }} barang dipilih
            </span>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
    @endif

    @php
        $total = 0;
    @endphp

    @if (count($keranjang) > 0)
        <div class="cart-layout">
            <section>
                <h2 class="section-label">Produk pilihanmu</h2>

                <div class="product-list">
                    @foreach ($keranjang as $item)
                        @php
                            $subtotal = $item['harga'] * $item['jumlah'];
                            $total += $subtotal;
                        @endphp

                        <article class="product-card">
                            @if (!empty($item['gambar']))
                                <img
                                    src="{{ asset('storage/' . $item['gambar']) }}"
                                    alt="{{ $item['nama_produk'] }}"
                                    class="product-image"
                                >
                            @else
                                <div class="product-image image-placeholder">
                                    <i class="fa-regular fa-image"></i>
                                </div>
                            @endif

                            <div class="product-info">
                                <div class="product-category">Produk kerajinan mahasiswa</div>
                                <h3 class="product-name">{{ $item['nama_produk'] }}</h3>

                                <div class="product-price">
                                    Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                </div>

                                <span class="quantity-info">
                                    <i class="fa-solid fa-box"></i>
                                    Jumlah: {{ $item['jumlah'] }}
                                </span>

                                <div class="subtotal">
                                    Subtotal:
                                    <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <aside class="summary-card">
                <h2 class="summary-title">
                    <i class="fa-solid fa-receipt me-2" style="color: var(--green);"></i>
                    Ringkasan Belanja
                </h2>

                <div class="summary-row">
                    <span>Jumlah barang</span>
                    <strong>{{ collect($keranjang)->sum('jumlah') }}</strong>
                </div>

                <div class="summary-row">
                    <span>Jenis produk</span>
                    <strong>{{ count($keranjang) }}</strong>
                </div>

                <hr class="summary-divider">

                <div class="total-label">Total Belanja</div>
                <div class="total-price">
                    Rp {{ number_format($total, 0, ',', '.') }}
                </div>

                <p class="summary-note">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Total dihitung berdasarkan harga dan jumlah produk pilihanmu.
                </p>

                <a href="{{ route('user.dashboard') }}" class="btn-green">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Produk Lain
                </a>
            </aside>
        </div>
    @else
        <section class="empty-card">
            <div class="empty-icon">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>

            <h2>Keranjangmu masih kosong</h2>
            <p>Yuk, temukan kerajinan mahasiswa yang kamu suka dan tambahkan ke keranjang.</p>

            <a href="{{ route('user.dashboard') }}" class="btn-green">
                <i class="fa-solid fa-store"></i>
                Mulai Belanja
            </a>
        </section>
    @endif
</main>

</body>
</html>
