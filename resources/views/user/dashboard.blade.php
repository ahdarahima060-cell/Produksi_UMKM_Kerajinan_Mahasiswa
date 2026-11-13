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

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--ink);
            font-family: Arial, Helvetica, sans-serif;
        }

        a { color: inherit; text-decoration: none; }
        button, input { font: inherit; }
        button { cursor: pointer; }

        /* NAVBAR & HERO (Tetap) */
        .navbar { position: sticky; top: 0; z-index: 10; display: flex; align-items: center; justify-content: space-between; gap: 24px; padding: 16px 5%; background: rgba(255, 255, 255, .96); border-bottom: 1px solid var(--line); }
        .brand { display: flex; align-items: center; gap: 12px; color: var(--green); font-family: Georgia, serif; font-size: 27px; font-weight: bold; white-space: nowrap; }
        .brand-mark { display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background-color: #315c49; color: white; border-radius: 10px; font-size: 20px; margin-right: 10px; }
        .nav-links { display: flex; align-items: center; gap: 28px; }
        .nav-links a { padding: 8px 0; color: #46544a; font-size: 14px; }
        .nav-links a.active { color: var(--green); border-bottom: 2px solid var(--green); }
        .nav-user { display: flex; align-items: center; gap: 12px; font-size: 13px; }
        .cart-nav { position: relative; display: inline-flex; align-items: center; gap: 7px; padding: 9px 12px; border: 1px solid var(--line); border-radius: 8px; color: var(--green); font-weight: 600; white-space: nowrap; }
        .cart-nav:hover { background: #edf3ed; }
        .cart-badge { position: absolute; top: -8px; right: -8px; min-width: 20px; height: 20px; padding: 0 5px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: #d94b42; color: white; border: 2px solid white; font-size: 10px; font-weight: bold; }
        .logout-button { padding: 9px 13px; border: 1px solid var(--line); border-radius: 7px; background: white; color: var(--green); }
        .logout-button:hover { background: #edf3ed; }
        .container { width: min(1380px, 92%); margin: 24px auto 50px; }
        .hero { display: grid; grid-template-columns: 1.1fr .9fr; align-items: center; min-height: 250px; overflow: hidden; border-radius: 14px; background: #e1e8dc; }
        .hero-copy { padding: 36px 44px; }
        .eyebrow { margin: 0 0 14px; color: var(--green); font-size: 12px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase; }
        .hero h1 { max-width: 560px; margin: 0 0 14px; color: var(--green-dark); font-family: Georgia, "Times New Roman", serif; font-size: clamp(32px, 3.3vw, 46px); font-weight: normal; line-height: 1.12; }
        .hero p { max-width: 520px; margin: 0; color: #46594b; font-size: 15px; line-height: 1.8; }
        .hero-art { display: flex; align-items: center; justify-content: center; height: 100%; min-height: 250px; padding: 18px; background: linear-gradient(135deg, #d4dfce, #edf0e4); }
        .hero-art img { width: 100%; height: 220px; object-fit: cover; border-radius: 10px; }
        .catalog-layout { display: grid; grid-template-columns: 240px minmax(0, 1fr); align-items: start; gap: 28px; margin-top: 26px; }
        .category-panel { padding: 20px 14px; border: 1px solid var(--line); border-radius: 12px; background: white; }
        .category-panel h2 { margin: 0 8px 16px; font-size: 19px; }
        .category-list { display: grid; gap: 5px; }
        .category-button { padding: 12px; border: 0; border-radius: 8px; background: transparent; color: #35473a; text-align: left; }
        .category-button:hover, .category-button.active { background: #e9efe5; color: var(--green); }
        .catalog-heading { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin: 8px 0 18px; }
        .catalog-heading h2 { margin: 0; color: var(--green-dark); font-size: 25px; }
        .product-count { color: var(--muted); font-size: 13px; }
        .search-box { width: 100%; margin-bottom: 18px; padding: 12px 15px; border: 1px solid #dfe4dd; border-radius: 9px; outline: none; background: white; }
        .search-box:focus { border-color: var(--green); box-shadow: 0 0 0 3px #315b4615; }
        .product-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; }
        .product-card { min-width: 0; overflow: hidden; border: 1px solid #eceee8; border-radius: 11px; background: white; box-shadow: 0 3px 12px #24352808; transition: transform .18s, box-shadow .18s; }
        .product-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px #24352812; }
        .product-image { display: block; width: 100%; height: 175px; object-fit: cover; background: #e9ede5; }
        .image-placeholder { display: none; width: 100%; height: 175px; place-items: center; padding: 12px; background: #e9ede5; color: var(--green); text-align: center; font-size: 13px; }
        .product-info { padding: 13px; }
        .product-category { margin: 0 0 7px; color: var(--muted); font-size: 11px; }
        .product-name { margin: 0 0 9px; font-size: 14px; line-height: 1.5; }
        .product-price { margin: 0 0 12px; color: var(--green-dark); font-size: 15px; font-weight: bold; }
        .stock-label { display: inline-block; padding: 6px 9px; border-radius: 20px; background: #e9efe5; color: var(--green); font-size: 11px; }
        .detail-button { width: 100%; margin-top: 12px; padding: 9px; border: 1px solid var(--green); border-radius: 7px; background: white; color: var(--green); font-size: 12px; font-weight: bold; }
        .detail-button:hover { background: var(--green); color: white; }
        .empty-state { display: none; grid-column: 1 / -1; padding: 40px 20px; border-radius: 10px; background: white; color: var(--muted); text-align: center; }
        .footer { padding: 25px 5%; border-top: 1px solid var(--line); color: var(--muted); font-size: 12px; text-align: center; }

        /* =========================================
           MODAL / POP-UP DETAIL PRODUK (FIX TOTAL)
           ========================================= */
        .modal {
            position: fixed;
            inset: 0;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(20, 30, 24, .55);
            backdrop-filter: blur(4px);
        }

        .modal.show { display: flex; }

        .modal-card {
            position: relative;
            display: grid;
            grid-template-columns: 1fr 1fr; /* 50:50 presisi */
            width: 100%;
            max-width: 900px; /* Lebar pas */
            height: 520px; /* Tinggi dikunci, tidak akan melar */
            overflow: hidden;
            border-radius: 16px;
            background: white;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .modal-image-wrapper {
            width: 100%;
            height: 100%;
            background: #e9ede5;
        }

        .modal-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .modal-info {
            padding: 50px 40px 40px 40px; /* Padding atas dilebarkan agar tidak tabrakan tombol X */
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            overflow-y: auto; /* Jika teks sangat panjang, bisa discroll */
        }
        
        /* Sembunyikan scrollbar agar bersih */
        .modal-info::-webkit-scrollbar { display: none; }
        .modal-info { -ms-overflow-style: none; scrollbar-width: none; }

        .modal-info .product-category {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #7b857d;
            border-bottom: 1px solid #dbe4d8;
            display: inline-block;
            padding-bottom: 5px;
            margin-bottom: 15px;
            align-self: flex-start;
        }

        .modal-info h2 {
            font-family: Georgia, serif;
            font-size: 28px;
            line-height: 1.2;
            color: var(--green-dark);
            margin: 0 0 12px 0;
        }

        .modal-price {
            font-size: 22px;
            font-weight: 700;
            color: var(--green);
            margin-bottom: 15px;
        }

        .modal-description {
            font-size: 14px;
            color: #526258;
            line-height: 1.6;
            margin-bottom: 20px;
            /* Pastikan teks tidak terlalu panjang */
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .modal-info .stock-label {
            padding: 6px 12px;
            font-size: 13px;
            margin-bottom: 20px;
            align-self: flex-start;
        }

        .quantity-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--green);
            margin-bottom: 8px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid #cbd9ce;
            border-radius: 8px;
            width: 140px;
            height: 40px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .quantity-control button {
            width: 40px;
            height: 100%;
            border: none;
            background: #f5f6f2;
            color: var(--green);
            font-size: 18px;
        }

        .quantity-control button:hover { background: #e2e8de; }

        .quantity-control input {
            width: 60px;
            height: 100%;
            border: none;
            text-align: center;
            font-weight: 600;
            color: var(--ink);
            outline: none;
        }

        .add-cart-button,
        .view-cart-button {
            display: flex;
            width: 100%;
            height: 44px; /* Tombol lebih proporsional */
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s;
            flex-shrink: 0; /* Mencegah tombol mengecil/terpotong */
        }

        .add-cart-button {
            background: var(--green);
            color: white;
            border: none;
            margin-bottom: 10px;
        }

        .add-cart-button:hover { background: var(--green-dark); }

        .view-cart-button {
            background: white;
            color: var(--green);
            border: 1px solid var(--green);
        }

        .view-cart-button:hover { background: #f5f6f2; }

        /* Tombol Close Posisi Pas */
        .close-button {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 36px;
            height: 36px;
            background: white;
            border: 1px solid #e5e9e1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            color: var(--ink);
            font-size: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: 0.2s;
        }
        
        .close-button:hover { background: #f5f6f2; }

        /* Responsif HP */
        @media (max-width: 768px) {
            .modal-card { grid-template-columns: 1fr; height: auto; max-height: 90vh; }
            .modal-image-wrapper { height: 250px; }
            .modal-info { padding: 40px 25px 25px 25px; }
            .product-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 480px) {
            .product-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

    <header class="navbar">
        <a href="{{ route('user.dashboard') }}" class="brand">
            <span class="brand-mark"><i class="fa-solid fa-leaf"></i></span>
            <span>UMKM Kerajinan Mahasiswa</span>
        </a>

        <nav class="nav-links">
            <a href="{{ route('user.dashboard') }}" class="active">Beranda</a>
            <a href="#produk">Produk</a>
            <a href="#tentang">Tentang Kami</a>
        </nav>

        <div class="nav-user">
            @php $jumlahKeranjang = collect(session('keranjang', []))->sum('jumlah'); @endphp
            <a href="{{ route('user.keranjang.index') }}" class="cart-nav">
                <i class="fa-solid fa-cart-shopping"></i> <span>Keranjang</span>
                @if ($jumlahKeranjang > 0) <span class="cart-badge">{{ $jumlahKeranjang }}</span> @endif
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
                <p>Temukan berbagai kerajinan tangan hasil karya mahasiswa dengan kreativitas dan makna.</p>
            </div>
            <div class="hero-art">
                <img src="{{ asset('images/products/banner-kerajinan.jpg') }}" alt="Kerajinan tangan mahasiswa">
            </div>
        </section>

        <section class="catalog-layout" id="produk">
            <aside class="category-panel">
                <h2>Kategori</h2>
                <div class="category-list">
                    <button class="category-button active" data-category="Semua">Semua Produk</button>
                    <button class="category-button" data-category="Rajut">Rajut</button>
                    <button class="category-button" data-category="Aksesoris">Aksesoris</button>
                    <button class="category-button" data-category="Tas">Tas</button>
                    <button class="category-button" data-category="Hiasan">Hiasan</button>
                </div>
            </aside>

            <div class="catalog-content">
                <div class="catalog-heading">
                    <h2>Semua Produk</h2>
                    <span class="product-count" id="productCount">Menampilkan {{ $products->count() }} produk</span>
                </div>

                <input type="search" id="searchProduct" class="search-box" placeholder="Cari nama produk kerajinan...">

                <div class="product-grid" id="productGrid">
                    @foreach ($products as $product)
                    <article class="product-card" data-name="{{ strtolower($product->nama_produk) }}" data-category="{{ $product->kategori }}">
                        <img
                            class="product-image"
                            src="{{ $product->gambar ? asset('images/products/' . $product->gambar) : '' }}"
                            alt="{{ $product->nama_produk }}"
                            loading="lazy"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">

                        <div class="image-placeholder">
                            {{ $product->nama_produk }}
                        </div>

                        <div class="product-info">
                            <p class="product-category">{{ $product->kategori }}</p>
                            <h3 class="product-name">{{ $product->nama_produk }}</h3>
                            <p class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                            <span class="stock-label">Stok: {{ $product->stok }}</span>

                            <button
                                type="button"
                                class="detail-button"
                                onclick="showProductDetail(this)"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->nama_produk }}"
                                data-price="{{ $product->harga }}"
                                data-stock="{{ $product->stok }}"
                                data-category="{{ $product->kategori }}"
                                data-image="{{ $product->gambar ? asset('images/products/' . $product->gambar) : '' }}"
                                data-description="{{ $product->deskripsi ?? 'Produk kerajinan mahasiswa.' }}">
                                Lihat Detail
                            </button>
                        </div>
                    </article>
                    @endforeach
                    <div class="empty-state" id="emptyState">Produk tidak ditemukan.</div>
                </div>
            </div>
        </section>

        <section id="tentang" style="margin-top: 40px; text-align: center;">
            <h2 style="color: var(--green);">Tentang Ruang Karya</h2>
            <p style="color: var(--muted); line-height: 1.8; max-width: 800px; margin: 0 auto;">
                Ruang Karya merupakan platform yang memperkenalkan berbagai produk kerajinan hasil kreativitas mahasiswa.
            </p>
        </section>
    </main>

    <footer class="footer">
        &copy; {{ date('Y') }} Ruang Karya — Produksi UMKM Kerajinan Mahasiswa
    </footer>

    <!-- MODAL DETAIL PRODUK -->
    <div class="modal" id="productModal" role="dialog" aria-modal="true">
        <div class="modal-card">
            <!-- Tombol Close diposisikan absolut di pojok kanan atas -->
            <button type="button" class="close-button" onclick="closeProductDetail()">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <!-- Gambar di kiri -->
            <div class="modal-image-wrapper">
                <img class="modal-image" id="modalImage" src="" alt="" onerror="this.src='https://via.placeholder.com/500x500?text=Gambar+Tidak+Ada';">
            </div>

            <!-- Teks di kanan -->
            <div class="modal-info">
                <p class="product-category" id="modalCategory"></p>
                <h2 id="modalName"></h2>
                <p class="modal-price" id="modalPrice"></p>
                <p class="modal-description" id="modalDescription"></p>
                <span class="stock-label" id="modalStock"></span>

                <form action="{{ route('user.keranjang.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="produk_id" id="keranjang_produk_id">
                    
                    <div class="quantity-label">Jumlah Produk</div>
                    <div class="quantity-control">
                        <button type="button" onclick="ubahJumlah(-1)">−</button>
                        <input type="number" name="jumlah" id="jumlah_produk" value="1" min="1" required>
                        <button type="button" onclick="ubahJumlah(1)">+</button>
                    </div>
                    
                    <button type="submit" class="add-cart-button">
                        <i class="fa-solid fa-cart-shopping"></i> Tambah ke Keranjang
                    </button>
                </form>

                <a href="{{ route('user.keranjang.index') }}" class="view-cart-button">
                    <i class="fa-solid fa-cart-shopping"></i> Lihat Keranjang
                </a>
            </div>
        </div>
    </div>

    <script>
        // Script untuk pencarian dan filter
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
                const matchesName = card.dataset.name.includes(keyword);
                const matchesCategory = selectedCategory === 'Semua' || card.dataset.category === selectedCategory;
                const visible = matchesName && matchesCategory;
                card.style.display = visible ? '' : 'none';
                if (visible) visibleCount++;
            });
            productCount.textContent = 'Menampilkan ' + visibleCount + ' produk';
            emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
        }

        searchInput.addEventListener('input', filterProducts);
        categoryButtons.forEach((button) => {
            button.addEventListener('click', () => {
                selectedCategory = button.dataset.category;
                categoryButtons.forEach(item => item.classList.remove('active'));
                button.classList.add('active');
                filterProducts();
            });
        });

        // Script untuk Modal
        function showProductDetail(button) {
            const modal = document.getElementById('productModal');
            const image = document.getElementById('modalImage');

            document.getElementById('keranjang_produk_id').value = button.dataset.id;
            document.getElementById('modalName').textContent = button.dataset.name;
            document.getElementById('modalCategory').textContent = button.dataset.category;
            document.getElementById('modalPrice').textContent = 'Rp ' + Number(button.dataset.price).toLocaleString('id-ID');
            document.getElementById('modalDescription').textContent = button.dataset.description;
            document.getElementById('modalStock').textContent = 'Stok: ' + button.dataset.stock;

            image.src = button.dataset.image;
            image.alt = button.dataset.name;

            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function ubahJumlah(perubahan) {
            const input = document.getElementById('jumlah_produk');
            if (!input) return;
            const stok = Number(document.getElementById('modalStock').textContent.replace(/\D/g, ''));
            const jumlah = Number(input.value) || 1;
            const maksimum = stok > 0 ? stok : 1;
            input.value = Math.min(maksimum, Math.max(1, jumlah + perubahan));
        }

        function closeProductDetail() {
            document.getElementById('productModal').classList.remove('show');
            document.body.style.overflow = '';
        }

        document.getElementById('productModal').addEventListener('click', (event) => {
            if (event.target.id === 'productModal') closeProductDetail();
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') closeProductDetail();
        });
    </script>

</body>
</html>