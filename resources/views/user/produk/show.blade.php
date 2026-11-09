<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $produk->nama_produk }} - Ruang Karya</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            color-scheme: light;
            --green: #315b46;
            --green-dark: #264633;
            --green-soft: #eaf1eb;
            --ink: #26382d;
            --muted: #718077;
            --line: #dce6de;
            --white: #fff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-width: 320px;
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 32px;
            overflow-x: hidden;
            background:
                radial-gradient(ellipse at 15% 20%, rgba(188, 207, 185, .55), transparent 38%),
                radial-gradient(ellipse at 85% 78%, rgba(218, 226, 208, .7), transparent 42%),
                #dce3dc;
            color: var(--ink);
            font-family: Arial, Helvetica, sans-serif;
        }

        button,
        input {
            font: inherit;
        }

        .detail-backdrop {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: rgba(23, 39, 30, .38);
            backdrop-filter: blur(5px);
        }

        .detail-modal {
            position: relative;
            display: grid;
            grid-template-columns: minmax(0, 1.02fr) minmax(380px, .98fr);
            width: min(100%, 1120px);
            min-height: min(76vh, 620px);
            max-height: calc(100vh - 64px);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .75);
            border-radius: 18px;
            background: var(--white);
            box-shadow: 0 26px 80px rgba(24, 41, 31, .28);
        }

        .product-visual {
            min-height: 620px;
            overflow: hidden;
            background: #f2f0e8;
        }

        .product-image {
            display: block;
            width: 100%;
            height: 100%;
            min-height: 620px;
            object-fit: cover;
        }

        .image-placeholder {
            display: grid;
            min-height: 620px;
            place-items: center;
            padding: 32px;
            color: #829186;
            text-align: center;
            font-size: 15px;
        }

        .image-placeholder i {
            display: block;
            margin-bottom: 14px;
            font-size: 44px;
        }

        .product-information {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 48px clamp(28px, 5vw, 70px);
            overflow-y: auto;
        }

        .close-button {
            position: absolute;
            top: 20px;
            right: 22px;
            display: grid;
            width: 40px;
            height: 40px;
            place-items: center;
            border: 0;
            border-radius: 50%;
            background: transparent;
            color: #47594d;
            font-size: 22px;
            text-decoration: none;
            transition: background .2s, color .2s;
        }

        .close-button:hover,
        .close-button:focus-visible {
            background: var(--green-soft);
            color: var(--green-dark);
        }

        .product-category {
            align-self: flex-start;
            margin: 0 0 12px;
            padding-bottom: 7px;
            border-bottom: 2px solid #9db8a5;
            color: #73887a;
            font-size: 13px;
        }

        .product-name {
            margin: 0;
            color: var(--green-dark);
            font-family: Georgia, 'Times New Roman', serif;
            font-size: clamp(30px, 3.2vw, 42px);
            line-height: 1.12;
            overflow-wrap: anywhere;
        }

        .product-price {
            margin: 22px 0 14px;
            color: var(--green);
            font-size: clamp(24px, 2.5vw, 30px);
            font-weight: 700;
        }

        .product-description {
            margin: 0 0 19px;
            color: #526258;
            font-size: 15px;
            line-height: 1.65;
            white-space: pre-line;
        }

        .stock-badge {
            display: inline-flex;
            align-items: center;
            align-self: flex-start;
            gap: 9px;
            margin-bottom: 25px;
            padding: 9px 13px;
            border-radius: 99px;
            background: var(--green-soft);
            color: var(--green);
            font-size: 13px;
        }

        .stock-badge.is-empty {
            background: #f8e9e7;
            color: #a2443c;
        }

        .quantity-label {
            display: block;
            margin-bottom: 9px;
            color: var(--green);
            font-size: 14px;
            font-weight: 700;
        }

        .quantity-control {
            display: grid;
            grid-template-columns: 42px 1fr 42px;
            align-items: center;
            width: min(100%, 260px);
            min-height: 52px;
            margin-bottom: 20px;
            padding: 5px 8px;
            border: 1px solid #cbd9ce;
            border-radius: 13px;
        }

        .quantity-control button {
            width: 32px;
            height: 32px;
            border: 0;
            border-radius: 50%;
            background: var(--green-soft);
            color: var(--green);
            font-size: 19px;
            font-weight: 700;
        }

        .quantity-control button:hover:not(:disabled) {
            background: #dce9df;
        }

        .quantity-control button:disabled {
            cursor: not-allowed;
            opacity: .5;
        }

        .quantity-control input {
            width: 100%;
            border: 0;
            outline: 0;
            background: transparent;
            color: var(--ink);
            font-weight: 700;
            text-align: center;
            appearance: textfield;
        }

        .quantity-control input::-webkit-inner-spin-button,
        .quantity-control input::-webkit-outer-spin-button {
            margin: 0;
            appearance: none;
        }

        .product-actions {
            display: grid;
            gap: 12px;
        }

        .action-button {
            display: inline-flex;
            min-height: 49px;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 18px;
            border: 1px solid var(--green);
            border-radius: 11px;
            color: var(--green);
            font-size: 14px;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
            transition: background .2s, color .2s, transform .2s;
        }

        .action-button:hover {
            transform: translateY(-1px);
        }

        .action-button-primary {
            background: linear-gradient(110deg, #315b46, #356a50);
            color: var(--white);
        }

        .action-button-primary:hover {
            background: var(--green-dark);
            color: var(--white);
        }

        .action-button-secondary {
            background: var(--white);
        }

        .action-button-secondary:hover {
            background: var(--green-soft);
        }

        .action-button:disabled {
            cursor: not-allowed;
            opacity: .55;
            transform: none;
        }

        .alert {
            margin: 0 0 16px;
            padding: 11px 13px;
            border-radius: 9px;
            background: #f8e9e7;
            color: #a2443c;
            font-size: 13px;
        }

        @media (max-width: 760px) {
            body {
                padding: 18px;
            }

            .detail-modal {
                grid-template-columns: 1fr;
                width: min(100%, 520px);
                max-height: calc(100vh - 36px);
                overflow-y: auto;
            }

            .product-visual,
            .product-image,
            .image-placeholder {
                min-height: 0;
                height: min(43vh, 340px);
            }

            .product-information {
                padding: 30px 26px 28px;
                overflow: visible;
            }

            .close-button {
                top: 12px;
                right: 12px;
                z-index: 1;
                background: rgba(255, 255, 255, .9);
            }

            .product-name {
                max-width: calc(100% - 36px);
            }

            .product-price {
                margin-top: 16px;
            }

            .stock-badge {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 420px) {
            body {
                padding: 10px;
            }

            .detail-modal {
                max-height: calc(100vh - 20px);
                border-radius: 14px;
            }

            .product-visual,
            .product-image,
            .image-placeholder {
                height: 34vh;
            }

            .product-information {
                padding: 24px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="detail-backdrop" aria-hidden="true"></div>

    <main class="detail-modal" aria-labelledby="product-name">
        <div class="product-visual">
            @if ($produk->gambar)
                <img
                    class="product-image"
                    src="{{ asset('storage/' . $produk->gambar) }}"
                    alt="{{ $produk->nama_produk }}"
                >
            @else
                <div class="image-placeholder">
                    <div>
                        <i class="fa-regular fa-image" aria-hidden="true"></i>
                        Foto produk belum tersedia.
                    </div>
                </div>
            @endif
        </div>

        <section class="product-information">
            <a
                href="{{ route('user.dashboard') }}"
                class="close-button"
                aria-label="Tutup detail produk"
            >
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </a>

            <p class="product-category">{{ $produk->kategori }}</p>
            <h1 class="product-name" id="product-name">{{ $produk->nama_produk }}</h1>
            <p class="product-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
            <p class="product-description">{{ $produk->deskripsi ?: 'Belum ada deskripsi produk.' }}</p>

            <p class="stock-badge {{ $produk->stok < 1 ? 'is-empty' : '' }}">
                <i class="fa-solid {{ $produk->stok < 1 ? 'fa-circle-exclamation' : 'fa-cube' }}" aria-hidden="true"></i>
                @if ($produk->stok > 0)
                    Stok tersedia: {{ $produk->stok }}
                @else
                    Stok habis
                @endif
            </p>

            @if (session('error'))
                <p class="alert" role="alert">{{ session('error') }}</p>
            @endif

            <form action="{{ route('user.keranjang.store') }}" method="POST">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                <label class="quantity-label" for="jumlah-produk">Jumlah produk</label>
                <div class="quantity-control">
                    <button
                        type="button"
                        id="quantity-decrease"
                        aria-label="Kurangi jumlah"
                        {{ $produk->stok < 1 ? 'disabled' : '' }}
                    >−</button>
                    <input
                        type="number"
                        id="jumlah-produk"
                        name="jumlah"
                        value="{{ $produk->stok > 0 ? 1 : 0 }}"
                        min="1"
                        max="{{ $produk->stok }}"
                        inputmode="numeric"
                        required
                        {{ $produk->stok < 1 ? 'disabled' : '' }}
                    >
                    <button
                        type="button"
                        id="quantity-increase"
                        aria-label="Tambah jumlah"
                        {{ $produk->stok < 1 ? 'disabled' : '' }}
                    >+</button>
                </div>

                <div class="product-actions">
                    <button
                        type="submit"
                        class="action-button action-button-primary"
                        {{ $produk->stok < 1 ? 'disabled' : '' }}
                    >
                        <i class="fa-solid fa-cart-plus" aria-hidden="true"></i>
                        Tambah ke Keranjang
                    </button>
                    <a href="{{ route('user.keranjang.index') }}" class="action-button action-button-secondary">
                        <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                        Lihat Keranjang
                    </a>
                </div>
            </form>
        </section>
    </main>

    <script>
        const quantityInput = document.getElementById('jumlah-produk');

        document.getElementById('quantity-decrease').addEventListener('click', () => {
            quantityInput.value = Math.max(Number(quantityInput.min), Number(quantityInput.value) - 1);
        });

        document.getElementById('quantity-increase').addEventListener('click', () => {
            quantityInput.value = Math.min(Number(quantityInput.max), Number(quantityInput.value) + 1);
        });

        quantityInput.addEventListener('change', () => {
            const min = Number(quantityInput.min);
            const max = Number(quantityInput.max);
            const value = Number(quantityInput.value);
            quantityInput.value = Math.min(max, Math.max(min, Number.isFinite(value) ? value : min));
        });
    </script>
</body>
</html>
