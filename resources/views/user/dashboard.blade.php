<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Produk — Ruang Karya</title>

    <style>
        :root {
            --green: #315b46;
            --green-dark: #264633;
            --cream: #f5f6f2;
            --ink: #202923;
            --muted: #707a73;
            --line: #e6e9e3;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--ink);
            font-family: Arial, Helvetica, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
            font: inherit;
        }

        button {
            cursor: pointer;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 16px 5%;
            background: rgba(255, 255, 255, .96);
            border-bottom: 1px solid var(--line);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--green);
            font-family: Georgia, serif;
            font-size: 27px;
            font-weight: bold;
            white-space: nowrap;
        }

        .brand-mark {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: #315c49;
            color: white;
            border-radius: 10px;
            font-size: 20px;
            margin-right: 10px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav-links a {
            padding: 8px 0;
            color: #46544a;
            font-size: 14px;
        }

        .nav-links a.active {
            color: var(--green);
            border-bottom: 2px solid var(--green);
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
        }

        .cart-nav {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 12px;
            border: 1px solid var(--line);
            border-radius: 8px;
            color: var(--green);
            font-weight: 600;
            white-space: nowrap;
        }

        .cart-nav:hover {
            background: #edf3ed;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            min-width: 20px;
            height: 20px;
            padding: 0 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #d94b42;
            color: white;
            border: 2px solid white;
            font-size: 10px;
            font-weight: bold;
        }


        .logout-button {
            padding: 9px 13px;
            border: 1px solid var(--line);
            border-radius: 7px;
            background: white;
            color: var(--green);
        }

        .logout-button:hover {
            background: #edf3ed;
        }

        .container {
            width: min(1380px, 92%);
            margin: 24px auto 50px;
        }

        .hero {
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            align-items: center;
            min-height: 250px;
            overflow: hidden;
            border-radius: 14px;
            background: #e1e8dc;
        }

        .hero-art img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            object-position: center;
            border-radius: inherit;
        }

        .hero-copy {
            padding: 36px 44px;
        }

        .eyebrow {
            margin: 0 0 14px;
            color: var(--green);
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .hero h1 {
            max-width: 560px;
            margin: 0 0 14px;
            color: var(--green-dark);
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(32px, 3.3vw, 46px);
            font-weight: normal;
            line-height: 1.12;
        }

        .hero p {
            max-width: 520px;
            margin: 0;
            color: #46594b;
            font-size: 15px;
            line-height: 1.8;
        }

        .hero-art {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            min-height: 250px;
            padding: 18px;
            background: linear-gradient(135deg, #d4dfce, #edf0e4);
        }

        .hero-art img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
        }

        .hero-placeholder {
            display: none;
            width: 100%;
            height: 220px;
            place-items: center;
            border: 1px dashed #9cac9c;
            border-radius: 10px;
            color: var(--green);
            text-align: center;
            line-height: 1.8;
        }

        .catalog-layout {
            display: grid;
            grid-template-columns: 240px minmax(0, 1fr);
            align-items: start;
            gap: 28px;
            margin-top: 26px;
        }

        .category-panel {
            padding: 20px 14px;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: white;
        }

        .category-panel h2 {
            margin: 0 8px 16px;
            font-size: 19px;
        }

        .category-list {
            display: grid;
            gap: 5px;
        }

        .category-button {
            padding: 12px;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: #35473a;
            text-align: left;
        }

        .category-button:hover,
        .category-button.active {
            background: #e9efe5;
            color: var(--green);
        }

        .catalog-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin: 8px 0 18px;
        }

        .catalog-heading h2 {
            margin: 0;
            color: var(--green-dark);
            font-size: 25px;
        }

        .product-count {
            color: var(--muted);
            font-size: 13px;
        }

        .search-box {
            width: 100%;
            margin-bottom: 18px;
            padding: 12px 15px;
            border: 1px solid #dfe4dd;
            border-radius: 9px;
            outline: none;
            background: white;
        }

        .search-box:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px #315b4615;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .product-card {
            min-width: 0;
            overflow: hidden;
            border: 1px solid #eceee8;
            border-radius: 11px;
            background: white;
            box-shadow: 0 3px 12px #24352808;
            transition: transform .18s, box-shadow .18s;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px #24352812;
        }

        .product-image {
            display: block;
            width: 100%;
            height: 175px;
            object-fit: cover;
            background: #e9ede5;
        }

        .image-placeholder {
            display: none;
            width: 100%;
            height: 175px;
            place-items: center;
            padding: 12px;
            background: #e9ede5;
            color: var(--green);
            text-align: center;
            font-size: 13px;
        }

        .product-info {
            padding: 13px;
        }

        .product-category {
            margin: 0 0 7px;
            color: var(--muted);
            font-size: 11px;
        }

        .product-name {
            margin: 0 0 9px;
            font-size: 14px;
            line-height: 1.5;
        }

        .product-price {
            margin: 0 0 12px;
            color: var(--green-dark);
            font-size: 15px;
            font-weight: bold;
        }

        .stock-label {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 20px;
            background: #e9efe5;
            color: var(--green);
            font-size: 11px;
        }

        .detail-button {
            width: 100%;
            margin-top: 12px;
            padding: 9px;
            border: 1px solid var(--green);
            border-radius: 7px;
            background: white;
            color: var(--green);
            font-size: 12px;
            font-weight: bold;
        }

        .detail-button:hover {
            background: var(--green);
            color: white;
        }

        .empty-state {
            display: none;
            grid-column: 1 / -1;
            padding: 40px 20px;
            border-radius: 10px;
            background: white;
            color: var(--muted);
            text-align: center;
        }

        .footer {
            padding: 25px 5%;
            border-top: 1px solid var(--line);
            color: var(--muted);
            font-size: 12px;
            text-align: center;
        }

        /* Detail produk */
        .modal {
            position: fixed;
            inset: 0;
            z-index: 100;
            display: none;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
            padding: 20px;
            background: #17251dcc;
        }

        .modal.show {
            display: flex;
        }

        .modal-card {
            position: relative;
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: min(720px, 100%);
            overflow: hidden;
            border-radius: 14px;
            background: white;
        }

        .modal-image {
            width: 100%;
            height: 100%;
            min-height: 300px;
            object-fit: cover;
            background: #e9ede5;
        }

        .modal-info {
            padding: 30px;
        }

        .modal-info h2 {
            margin: 8px 0 12px;
            color: var(--green-dark);
            font-family: Georgia, serif;
            font-size: 27px;
        }

        .modal-price {
            color: var(--green);
            font-size: 21px;
            font-weight: bold;
        }

        .modal-description {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 35px;
            height: 35px;
            border: 0;
            border-radius: 50%;
            background: white;
            color: var(--ink);
            font-size: 22px;
        }

        @media (max-width: 1100px) {
            .product-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .navbar {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 760px) {
            .nav-links {
                order: 3;
                width: 100%;
                justify-content: center;
                gap: 22px;
            }

            .brand {
                font-size: 22px;
            }

            .nav-user {
                font-size: 12px;
            }

            .hero {
                grid-template-columns: 1fr;
            }

            .hero-copy {
                padding: 28px 24px;
            }

            .hero-art {
                min-height: 170px;
            }

            .hero-art img,
            .hero-placeholder {
                height: 170px;
            }

            .catalog-layout {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .category-list {
                display: flex;
                flex-wrap: wrap;
            }

            .category-button {
                padding: 9px 12px;
            }

            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .product-image,
            .image-placeholder {
                height: 145px;
            }

            .modal-card {
                grid-template-columns: 1fr;
                max-width: 420px;
            }

            .modal-image {
                height: 220px;
                min-height: 0;
            }

            .modal-info {
                padding: 22px;
            }
        }

        @media (max-width: 380px) {
            .nav-user span {
                display: none;
            }

            .product-grid {
                grid-template-columns: 1fr;
            }


            .add-cart-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                width: 100%;
                padding: 11px 16px;
                margin-top: 12px;
                border: none;
                border-radius: 8px;
                background: #315b46;
                color: #ffffff;
                font-family: inherit;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                transition: background 0.2s ease;
            }

            .add-cart-button:hover {
                background: #244535;
            }

            .add-cart-button svg {
                display: block;
                width: 19px !important;
                height: 19px !important;
                min-width: 19px;
                max-width: 19px;
                flex-shrink: 0;
            }

            .quantity-label {
                display: block;
                margin: 18px 0 9px;
                color: #315b46;
                font-size: 14px;
                font-weight: 600;
            }

            .quantity-control {
                display: flex;
                align-items: center;
                width: 190px;
                height: 46px;
                overflow: hidden;
                border: 1px solid #dce6da;
                border-radius: 10px;
                background: #fff;
            }

            .quantity-control button {
                width: 45px;
                height: 44px;
                border: 0;
                background: #edf3e9;
                color: #315b46;
                font-size: 22px;
                cursor: pointer;
            }

            .quantity-control button:hover {
                background: #dce8d9;
            }

            .quantity-control input {
                width: 100%;
                min-width: 0;
                height: 44px;
                padding: 0;
                border: 0;
                outline: none;
                text-align: center;
                font: inherit;
                color: #315b46;
                appearance: textfield;
                -moz-appearance: textfield;
            }

            .quantity-control input::-webkit-inner-spin-button,
            .quantity-control input::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            .view-cart-button {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 9px;
                width: 100%;
                min-height: 46px;
                margin-top: 12px;
                padding: 12px;
                border: 1px solid #315b46;
                border-radius: 9px;
                background: #fff;
                color: #315b46;
                text-decoration: none;
                font-size: 14px;
                font-weight: 600;
                transition: .2s;
            }

            .view-cart-button:hover {
                background: #edf3e9;
                color: #244535;
            }



        }

        .modal {
            background: rgba(23, 37, 29, .58);
            backdrop-filter: blur(5px);
        }

        .modal-card {
            grid-template-columns: minmax(0, 1.08fr) minmax(350px, .92fr);
            width: min(940px, 100%);
            min-height: min(580px, calc(100vh - 64px));
            max-height: calc(100vh - 64px);
            border: 1px solid rgba(255, 255, 255, .8);
            border-radius: 18px;
            box-shadow: 0 26px 80px rgba(24, 41, 31, .28);
        }

        .modal-image {
            width: 100%;
            height: 100%;
            min-height: 560px;
        }

        .modal-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 46px clamp(28px, 4vw, 58px);
            overflow-y: auto;
        }

        .modal-info .product-category {
            align-self: flex-start;
            margin: 0 0 12px;
            padding-bottom: 7px;
            border-bottom: 2px solid #9db8a5;
            color: #73887a;
            font-size: 13px;
        }

        .modal-info h2 {
            max-width: 100%;
            margin: 0;
            color: var(--green-dark);
            font-size: clamp(30px, 3vw, 40px);
            line-height: 1.12;
            overflow-wrap: anywhere;
        }

        .modal-price {
            margin: 22px 0 14px;
            font-size: clamp(24px, 2.4vw, 30px);
        }

        .modal-description {
            margin: 0 0 18px;
            color: #526258;
            font-size: 15px;
            line-height: 1.65;
        }

        .modal-info .stock-label {
            align-self: flex-start;
            margin-bottom: 23px;
            padding: 9px 13px;
            font-size: 13px;
        }

        .close-button {
            top: 18px;
            right: 18px;
            z-index: 1;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, .92);
            color: #47594d;
            font-size: 24px;
        }

        .modal-info form {
            margin: 0;
        }

        .modal-info form .mb-3 {
            margin: 0 0 18px;
        }

        .quantity-label {
            display: block;
            margin: 0 0 9px;
            color: var(--green);
            font-size: 14px;
            font-weight: 700;
        }

        .quantity-control {
            display: grid;
            grid-template-columns: 42px 1fr 42px;
            align-items: center;
            width: min(260px, 100%);
            height: 52px;
            overflow: hidden;
            border: 1px solid #cbd9ce;
            border-radius: 13px;
            background: #fff;
        }

        .quantity-control button {
            width: 32px;
            height: 32px;
            justify-self: center;
            border: 0;
            border-radius: 50%;
            background: #eaf1eb;
            color: var(--green);
            font-size: 20px;
            font-weight: 700;
        }

        .quantity-control button:hover {
            background: #dce9df;
        }

        .quantity-control input {
            width: 100%;
            min-width: 0;
            height: 44px;
            padding: 0;
            border: 0;
            outline: none;
            background: transparent;
            color: var(--ink);
            font-weight: 700;
            text-align: center;
            appearance: textfield;
            -moz-appearance: textfield;
        }

        .quantity-control input::-webkit-inner-spin-button,
        .quantity-control input::-webkit-outer-spin-button {
            margin: 0;
            -webkit-appearance: none;
        }

        .add-cart-button,
        .view-cart-button {
            display: flex;
            width: 100%;
            min-height: 49px;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 12px 16px;
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
            transition: background .2s, color .2s, transform .2s;
        }

        .add-cart-button {
            margin: 0;
            border: 1px solid var(--green);
            background: var(--green);
            color: #fff;
            cursor: pointer;
        }

        .add-cart-button:hover {
            transform: translateY(-1px);
            background: var(--green-dark);
        }

        .add-cart-button svg {
            display: block;
            width: 19px;
            height: 19px;
            flex: 0 0 19px;
        }

        .view-cart-button {
            margin-top: 12px;
            border: 1px solid var(--green);
            background: #fff;
            color: var(--green);
        }

        .view-cart-button:hover {
            transform: translateY(-1px);
            background: #edf3e9;
            color: var(--green-dark);
        }

        @media (max-width: 760px) {
            .modal {
                padding: 16px;
            }

            .modal-card {
                grid-template-columns: 1fr;
                width: min(520px, 100%);
                min-height: 0;
                max-height: calc(100vh - 32px);
                overflow-y: auto;
            }

            .modal-image {
                height: clamp(190px, 36vh, 300px);
                min-height: 0;
            }

            .modal-info {
                padding: 28px 26px;
                overflow: visible;
            }

            .modal-info h2 {
                max-width: calc(100% - 34px);
            }
        }

        @media (max-width: 420px) {
            .modal {
                padding: 10px;
            }

            .modal-card {
                max-height: calc(100vh - 20px);
                border-radius: 14px;
            }

            .modal-info {
                padding: 23px 20px;
            }
        }
    </style>
</head>

<body>



    <header class="navbar">
        <a href="{{ route('user.dashboard') }}" class="brand">
            <span class="brand-mark">
                <i class="fa-solid fa-leaf"></i>
            </span>
            <span>UMKM Kerajinan Mahasiswa</span>
        </a>

        <nav class="nav-links">
            <a href="{{ route('user.dashboard') }}" class="active">Beranda</a>
            <a href="#produk">Produk</a>
            <a href="#tentang">Tentang Kami</a>
        </nav>


        <div class="nav-user">
            @php
            $jumlahKeranjang = collect(session('keranjang', []))->sum('jumlah');
            @endphp

            <a href="{{ route('user.keranjang.index') }}"
                class="cart-nav"
                aria-label="Keranjang belanja"
                title="Keranjang Belanja">

                <i class="fa-solid fa-cart-shopping"></i>
                <span>Keranjang</span>

                @if ($jumlahKeranjang > 0)
                <span class="cart-badge">{{ $jumlahKeranjang }}</span>
                @endif
            </a>

            <span>Halo, {{ Auth::user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">Keluar</button>
            </form>
        </div>

    </header>

    <main class="container">

        <section class="hero">
            <div class="hero-copy">
                <p class="eyebrow">Produksi UMKM Kerajinan Mahasiswa</p>

                <h1>Karya Mahasiswa, Untuk Masa Depan</h1>

                <p>
                    Temukan berbagai kerajinan tangan hasil karya mahasiswa
                    dengan kreativitas dan makna.
                </p>
            </div>

            <div class="hero-art">
                <img
                    src="{{ asset('images/products/banner-kerajinan.jpg') }}"
                    alt="Kerajinan tangan mahasiswa">
            </div>
        </section>

        <section class="catalog-layout" id="produk">

            <aside class="category-panel">
                <h2>Kategori</h2>

                <div class="category-list">
                    <button class="category-button active" data-category="Semua">
                        Semua Produk
                    </button>

                    <button class="category-button" data-category="Rajut">
                        Rajut
                    </button>

                    <button class="category-button" data-category="Aksesoris">
                        Aksesoris
                    </button>

                    <button class="category-button" data-category="Tas">
                        Tas
                    </button>

                    <button class="category-button" data-category="Hiasan">
                        Hiasan
                    </button>
                </div>
            </aside>

            <div class="catalog-content">
                <div class="catalog-heading">
                    <h2>Semua Produk</h2>
                    <span class="product-count" id="productCount">
                        Menampilkan {{ $products->count() }} produk
                    </span>
                </div>

                <input
                    type="search"
                    id="searchProduct"
                    class="search-box"
                    placeholder="Cari nama produk kerajinan..."
                    aria-label="Cari produk">

                <div class="product-grid" id="productGrid">

                    @foreach ($products as $product)
                    <article
                        class="product-card"
                        data-name="{{ strtolower($product->nama_produk) }}"
                        data-category="{{ $product->kategori }}">
                        <img
                            class="product-image"
                            src="{{ $product->gambar ? asset('storage/' . $product->gambar) : '' }}"
                            alt="{{ $product->nama_produk }}"
                            loading="lazy"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">

                        <div class="image-placeholder">
                            {{ $product->nama_produk }}
                        </div>

                        <div class="product-info">
                            <p class="product-category">
                                {{ $product->kategori }}
                            </p>

                            <h3 class="product-name">
                                {{ $product->nama_produk }}
                            </h3>

                            <p class="product-price">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </p>

                            <span class="stock-label">
                                Stok: {{ $product->stok }}
                            </span>

                            <button
                                type="button"
                                class="detail-button"
                                onclick="showProductDetail(this)"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->nama_produk }}"
                                data-price="{{ $product->harga }}"
                                data-stock="{{ $product->stok }}"
                                data-category="{{ $product->kategori }}"
                                data-image="{{ $product->gambar ? asset('storage/' . $product->gambar) : '' }}"
                                data-description="{{ $product->deskripsi ?? 'Produk kerajinan mahasiswa.' }}">
                                Lihat Detail
                            </button>
                        </div>
                    </article>
                    @endforeach

                    <div class="empty-state" id="emptyState">
                        Produk tidak ditemukan.
                        Coba kata kunci atau kategori lainnya.
                    </div>

                </div>
            </div>
        </section>

        <section id="tentang" style="margin-top: 40px; text-align: center;">
            <h2 style="color: var(--green);">Tentang Ruang Karya</h2>
            <p style="color: var(--muted); line-height: 1.8;">
                Ruang Karya merupakan platform yang memperkenalkan berbagai produk kerajinan hasil kreativitas mahasiswa.
                Kami hadir sebagai wadah untuk menampilkan karya buatan tangan yang memiliki nilai kreativitas, keunikan, dan manfaat.
                Melalui Ruang Karya, pengunjung dapat mengenal berbagai kerajinan mahasiswa, mulai dari aksesori manik-manik, produk rajutan,
                tas handmade, hingga hiasan dekoratif. Kami berharap setiap karya dapat menjadi langkah kecil untuk mengembangkan kreativitas
                dan semangat kewirausahaan mahasiswa.
            </p>
        </section>

    </main>

    <footer class="footer">
        &copy; {{ date('Y') }} Ruang Karya — Produksi UMKM Kerajinan Mahasiswa
    </footer>

    <!-- Modal detail produk -->
    <div class="modal" id="productModal" role="dialog" aria-modal="true" aria-labelledby="modalName">
        <div class="modal-card">
            <button
                type="button"
                class="close-button"
                onclick="closeProductDetail()"
                aria-label="Tutup detail">
                &times;
            </button>

            <img class="modal-image" id="modalImage" src="" alt="">

            <div class="modal-info">
                <p class="product-category" id="modalCategory"></p>

                <h2 id="modalName"></h2>

                <p class="modal-price" id="modalPrice"></p>

                <p class="modal-description" id="modalDescription"></p>

                <span class="stock-label" id="modalStock"></span>

                <form action="{{ route('user.keranjang.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="produk_id" id="keranjang_produk_id">

                    <div class="mb-3">

                        <label for="jumlah_produk" class="quantity-label">
                            Jumlah Produk
                        </label>

                        <div class="quantity-control">
                            <button type="button" onclick="ubahJumlah(-1)" aria-label="Kurangi jumlah">−</button>

                            <input
                                type="number"
                                name="jumlah"
                                id="jumlah_produk"
                                value="1"
                                min="1"
                                required>

                            <button type="button" onclick="ubahJumlah(1)" aria-label="Tambah jumlah">+</button>
                        </div>




                        <button type="submit" class="add-cart-button">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="19" height="19"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="9" cy="21" r="1" />
                                <circle cx="20" cy="21" r="1" />
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                                <path d="M12 8v6m-3-3h6" />
                            </svg>
                            <span>Tambah ke Keranjang</span>
                        </button>

                </form>



                <a href="{{ route('user.keranjang.index') }}" class="view-cart-button">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Lihat Keranjang
                </a>

            </div>
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchProduct');
        const productCards = document.querySelectorAll('.product-card');
        const categoryButtons = document.querySelectorAll('.category-button');
        const productCount = document.getElementById('productCount');
        const emptyState = document.getElementById('emptyState');

        let selectedCategory = 'Semua';

        function filterProducts() {
            const keyword = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            productCards.forEach((card) => {
                const name = card.dataset.name;
                const category = card.dataset.category;

                const matchesName = name.includes(keyword);
                const matchesCategory =
                    selectedCategory === 'Semua' ||
                    category === selectedCategory;

                const visible = matchesName && matchesCategory;

                card.style.display = visible ? '' : 'none';

                if (visible) {
                    visibleCount++;
                }
            });

            productCount.textContent =
                'Menampilkan ' + visibleCount + ' produk';

            emptyState.style.display =
                visibleCount === 0 ? 'block' : 'none';
        }

        searchInput.addEventListener('input', filterProducts);

        categoryButtons.forEach((button) => {
            button.addEventListener('click', () => {
                selectedCategory = button.dataset.category;

                categoryButtons.forEach((item) => {
                    item.classList.remove('active');
                });

                button.classList.add('active');
                filterProducts();
            });
        });

        function showProductDetail(button) {
            const modal = document.getElementById('productModal');
            const image = document.getElementById('modalImage');

            document.getElementById('keranjang_produk_id').value =
                button.dataset.id;

            document.getElementById('modalName').textContent =
                button.dataset.name;

            document.getElementById('modalCategory').textContent =
                button.dataset.category;

            document.getElementById('modalPrice').textContent =
                'Rp ' + Number(button.dataset.price).toLocaleString('id-ID');

            document.getElementById('modalDescription').textContent =
                button.dataset.description;

            document.getElementById('modalStock').textContent =
                'Stok: ' + button.dataset.stock;

            image.src = button.dataset.image;
            image.alt = button.dataset.name;
            image.style.display = 'block';

            image.onerror = function() {
                this.style.display = 'none';
            };

            modal.classList.add('show');
            document.body.style.overflow = 'hidden';

            modal.querySelector('.close-button').focus();
        }

        function ubahJumlah(perubahan) {
            const input = document.getElementById('jumlah_produk');
            if (!input) return;

            const stok = Number(
                document.getElementById('modalStock')
                .textContent.replace(/\D/g, '')
            );

            const jumlah = Number(input.value) || 1;
            const maksimum = stok > 0 ? stok : 1;

            input.value = Math.min(
                maksimum,
                Math.max(1, jumlah + perubahan)
            );
        }


        function closeProductDetail() {
            document.getElementById('productModal').classList.remove('show');
            document.body.style.overflow = '';
        }

        document.getElementById('productModal').addEventListener('click', (event) => {
            if (event.target.id === 'productModal') {
                closeProductDetail();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeProductDetail();
            }
        });
    </script>

</body>

</html>