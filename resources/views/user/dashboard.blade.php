
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
        }
    </style>
</head>

<body>

    @php
        $products = [
            [
                'name' => 'Gelang Manik',
                'price' => 15000,
                'stock' => 15,
                'category' => 'Aksesoris',
                'image' => 'gelang-manik.png',
                'description' => 'Gelang handmade dari manik-manik dengan kombinasi warna yang menarik.'
            ],
            [
                'name' => 'Gantungan Kunci Manik',
                'price' => 10000,
                'stock' => 20,
                'category' => 'Aksesoris',
                'image' => 'gantungan-kunci-manik.png',
                'description' => 'Gantungan kunci buatan tangan yang cocok untuk aksesori tas atau kunci.'
            ],
            [
                'name' => 'Tote Bag Handmade',
                'price' => 35000,
                'stock' => 8,
                'category' => 'Tas',
                'image' => 'Tote-Bag-Handmade.jpeg',
                'description' => 'Tas kain sederhana yang cocok digunakan untuk kuliah dan aktivitas sehari-hari.'
            ],
            [
                'name' => 'Buket Kertas',
                'price' => 25000,
                'stock' => 12,
                'category' => 'Hiasan',
                'image' => 'bucket-bunga-kertas.jpg',
                'description' => 'Buket bunga dari kertas yang dibuat secara handmade sebagai hadiah.'
            ],
            [
                'name' => 'Hiasan Dinding',
                'price' => 30000,
                'stock' => 10,
                'category' => 'Hiasan',
                'image' => 'hiasan-dinding.jpg',
                'description' => 'Hiasan dinding buatan tangan untuk mempercantik ruang.'
            ],
            [
                'name' => 'Tempat Pensil Rajut',
                'price' => 20000,
                'stock' => 14,
                'category' => 'Rajut',
                'image' => 'tempat-pensil.jpeg',
                'description' => 'Tempat alat tulis dengan tampilan rajut yang unik dan menarik.'
            ],
            [
                'name' => 'Bookmark Rajut',
                'price' => 8000,
                'stock' => 18,
                'category' => 'Rajut',
                'image' => 'bookmark.jpeg',
                'description' => 'Pembatas buku handmade untuk menemani kegiatan membaca.'
            ],
            [
                'name' => 'Strap HP Manik',
                'price' => 12000,
                'stock' => 16,
                'category' => 'Aksesoris',
                'image' => 'Strap-HP-Manik-Manik.jpeg',
                'description' => 'Strap HP dengan manik-manik warna-warni sebagai aksesori ponsel.'
            ],
        ];
    @endphp

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
                    alt="Kerajinan tangan mahasiswa"
                >
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
                        Menampilkan {{ count($products) }} produk
                    </span>
                </div>

                <input
                    type="search"
                    id="searchProduct"
                    class="search-box"
                    placeholder="Cari nama produk kerajinan..."
                    aria-label="Cari produk"
                >

                <div class="product-grid" id="productGrid">

                    @foreach ($products as $product)
                        <article
                            class="product-card"
                            data-name="{{ strtolower($product['name']) }}"
                            data-category="{{ $product['category'] }}"
                        >
                            <img
                                class="product-image"
                                src="{{ asset('images/products/' . $product['image']) }}"
                                alt="{{ $product['name'] }}"
                                loading="lazy"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';"
                            >

                            <div class="image-placeholder">
                                {{ $product['name'] }}
                            </div>

                            <div class="product-info">
                                <p class="product-category">
                                    {{ $product['category'] }}
                                </p>

                                <h3 class="product-name">
                                    {{ $product['name'] }}
                                </h3>

                                <p class="product-price">
                                    Rp {{ number_format($product['price'], 0, ',', '.') }}
                                </p>


                                <button
                                    type="button"
                                    
                                    data-name="{{ $product['name'] }}"
                                    data-price="{{ $product['price'] }}"
                                    data-stock="{{ $product['stock'] }}"
                                    data-category="{{ $product['category'] }}"
                                    data-image="{{ asset('images/products/' . $product['image']) }}"
                                    data-description="{{ $product['description'] }}"
                                    
                                >
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
                aria-label="Tutup detail"
            >
                &times;
            </button>

            <img class="modal-image" id="modalImage" src="" alt="">

            <div class="modal-info">
                <p class="product-category" id="modalCategory"></p>

                <h2 id="modalName"></h2>

                <p class="modal-price" id="modalPrice"></p>

                <p class="modal-description" id="modalDescription"></p>

                <span class="stock-label" id="modalStock"></span>

                <button
                    type="button"
                    class="detail-button"
                    onclick="closeProductDetail()"
                >
                    Kembali ke Produk
                </button>
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

            image.onerror = function () {
                this.style.display = 'none';
            };

            modal.classList.add('show');
            document.body.style.overflow = 'hidden';

            modal.querySelector('.close-button').focus();
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
