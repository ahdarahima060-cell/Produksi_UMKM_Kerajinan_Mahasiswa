
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ruang Karya — Produksi UMKM</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f7f7f2;
            color: #202923;
            font-family: Arial, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .container {
            width: min(100% - 40px, 1040px);
            margin: 0 auto;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 0;
            border-bottom: 1px solid #e5e7df;
        }

        .brand {
            font-size: 19px;
            font-weight: 700;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 18px;
            font-size: 14px;
        }

        nav a:last-child,
        .button {
            padding: 10px 15px;
            border-radius: 6px;
            background: #315b46;
            color: white;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            padding: 64px 0 52px;
        }

        .hero-copy {
            max-width: 600px;
        }

        .eyebrow {
            margin: 0 0 14px;
            color: #315b46;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-family: Georgia, serif;
            font-size: clamp(38px, 6vw, 58px);
            font-weight: 400;
            line-height: 1.12;
        }

        .hero-copy > p:not(.eyebrow) {
            max-width: 520px;
            margin: 18px 0 22px;
            color: #68746d;
            line-height: 1.7;
        }

        .hero-art {
            display: grid;
            width: 210px;
            height: 210px;
            flex: 0 0 210px;
            place-items: center;
            border-radius: 50%;
            background: #e6eadf;
            color: #315b46;
            font-size: 74px;
        }

        /* KATALOG PRODUK */

        .section {
            padding: 28px 0 40px;
            border-top: 1px solid #e5e7df;
        }

        h2 {
            margin: 0 0 7px;
            font-family: Georgia, serif;
            font-size: 30px;
            font-weight: 400;
        }

        .section-intro {
            margin: 0 0 20px;
            color: #68746d;
            font-size: 14px;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .product {
            overflow: hidden;
            border: 1px solid #e5e7df;
            border-radius: 8px;
            background: #fff;
            transition: transform .2s, box-shadow .2s;
        }

        .product:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(32, 41, 35, .08);
        }

        .product-image {
            height: 145px;
            overflow: hidden;
            background: #e9e6dc;
        }

        .product-image img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 13px;
        }

        .product-info h3 {
            margin: 0 0 6px;
            font-size: 15px;
        }

        .product-info p {
            min-height: 36px;
            margin: 0 0 10px;
            color: #68746d;
            font-size: 12px;
            line-height: 1.5;
        }

        .product-price {
            display: block;
            margin-bottom: 11px;
            color: #315b46;
            font-size: 16px;
            font-weight: 700;
        }

        .detail-button {
            display: block;
            width: 100%;
            padding: 10px;
            border: 0;
            border-radius: 5px;
            background: #315b46;
            color: white;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .detail-button:hover {
            background: #244735;
        }

        /* BAGIAN BAWAH LANDING PAGE */

        .bottom-section {
            margin-top: 10px;
            padding: 38px 0;
            border-top: 1px solid #e5e7df;
        }

        .bottom-heading {
            max-width: 550px;
            margin-bottom: 24px;
        }

        .bottom-heading h2 {
            margin: 0 0 10px;
        }

        .bottom-heading > p:last-child {
            margin: 0;
            color: #68746d;
            font-size: 14px;
            line-height: 1.7;
        }

        .benefit-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .benefit-card {
            padding: 20px;
            border: 1px solid #e5e7df;
            border-radius: 8px;
            background: #fff;
        }

        .benefit-icon {
            display: grid;
            width: 42px;
            height: 42px;
            margin-bottom: 14px;
            place-items: center;
            border-radius: 8px;
            background: #edf0e7;
            color: #315b46;
            font-size: 22px;
        }

        .benefit-card h3 {
            margin: 0 0 8px;
            font-size: 15px;
        }

        .benefit-card p {
            margin: 0;
            color: #68746d;
            font-size: 13px;
            line-height: 1.7;
        }

        .bottom-cta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-top: 28px;
            padding: 26px;
            border-radius: 9px;
            background: #315b46;
            color: white;
        }

        .bottom-cta h2 {
            margin: 0 0 8px;
            font-size: 25px;
        }

        .bottom-cta p {
            margin: 0;
            color: #e0e9e2;
            font-size: 13px;
            line-height: 1.7;
        }

        .button-light {
            display: inline-block;
            flex-shrink: 0;
            padding: 11px 16px;
            border-radius: 6px;
            background: #f7f7f2;
            color: #315b46;
            font-size: 13px;
            font-weight: 700;
        }

        footer {
            padding: 17px 0;
            border-top: 1px solid #e5e7df;
            color: #68746d;
            font-size: 12px;
        }

        /* POPUP DETAIL PRODUK */

        .modal {
            position: fixed;
            inset: 0;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(20, 30, 24, .55);
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            position: relative;
            width: 100%;
            max-width: 650px;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 12px;
            background: #fff;
        }

        .modal-close {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 2;
            display: grid;
            width: 34px;
            height: 34px;
            place-items: center;
            border: 0;
            border-radius: 50%;
            background: white;
            color: #202923;
            font-size: 23px;
            cursor: pointer;
            box-shadow: 0 2px 8px #00000015;
        }

        .modal-image {
            width: 100%;
            height: 260px;
            object-fit: cover;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-body h2 {
            margin-bottom: 12px;
            font-family: Arial, sans-serif;
            font-size: 24px;
            font-weight: 700;
        }

        .modal-price {
            margin: 0 0 18px;
            color: #315b46;
            font-size: 22px;
            font-weight: 700;
        }

        .modal-label {
            margin: 18px 0 6px;
            font-size: 14px;
            font-weight: 700;
        }

        .modal-description {
            color: #68746d;
            font-size: 14px;
            line-height: 1.7;
        }

        .modal-material {
            color: #68746d;
            font-size: 14px;
            line-height: 1.7;
        }

        @media (max-width: 800px) {
            .products {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .hero-art {
                width: 150px;
                height: 150px;
                flex-basis: 150px;
                font-size: 55px;
            }
        }

        @media (max-width: 600px) {
            .container {
                width: calc(100% - 28px);
            }

            .hero {
                padding: 44px 0 36px;
                gap: 16px;
            }

            .hero-art {
                width: 75px;
                height: 75px;
                flex-basis: 75px;
                font-size: 30px;
            }

            .benefit-grid {
                grid-template-columns: 1fr;
            }

            .bottom-cta {
                align-items: flex-start;
                flex-direction: column;
                padding: 21px;
            }

            .product-image {
                height: 125px;
            }

            .modal-image {
                height: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <header>
            <a class="brand" href="{{ url('/') }}">
                <span class="brand-mark">
                    <i class="fa-solid fa-leaf"></i>
                </span>
                UMKM Kerajinan Mahasiswa
            </a>

            <nav aria-label="Navigasi akun">
                <a href="{{ route('login') }}">Masuk</a>
                <a href="{{ route('register') }}">Daftar</a>
            </nav>
        </header>

        <main>
            <!-- HERO LAMA -->

            <section class="hero">
                <div class="hero-copy">
                    <p class="eyebrow">Kerajinan UMKM Mahasiswa</p>

                    <h1>Setiap karya punya cerita.</h1>

                    <p>
                        Lihat berbagai contoh kerajinan buatan mahasiswa.
                        Kenali kreativitas di balik setiap karya,
                        mulai dari aksesori hingga kerajinan rajut.
                    </p>

                    <a class="button" href="#produk">
                        Lihat contoh produk
                    </a>
                </div>

                <div class="hero-art" aria-hidden="true">✿</div>
            </section>

            <!-- KATALOG PRODUK -->

            <section class="section" id="produk">
                <h2>Contoh kerajinan</h2>

                <p class="section-intro">
                    Beberapa ide karya kreatif dari UMKM mahasiswa.
                </p>

                <div class="products">

                    <article class="product">
                        <div class="product-image">
                            <img
                                src="{{ asset('images/products/gelang-manik.png') }}"
                                alt="Gelang Manik">
                        </div>

                        <div class="product-info">
                            <h3>Gelang Manik</h3>
                            <p>Aksesori handmade dari rangkaian manik.</p>
                            <span class="product-price">Rp15.000</span>

                            <button class="detail-button"
                                onclick="showDetail(0)">
                                Lihat Detail
                            </button>
                        </div>
                    </article>

                    <article class="product">
                        <div class="product-image">
                            <img
                                src="{{ asset('images/products/Strap-HP-Manik-Manik.jpeg') }}"
                                alt="Strap HP Manik-Manik">
                        </div>

                        <div class="product-info">
                            <h3>Strap HP Manik-Manik</h3>
                            <p>Aksesori handmade untuk HP dengan rangkaian manik.</p>
                            <span class="product-price">Rp15.000</span>

                            <button class="detail-button"
                                onclick="showDetail(1)">
                                Lihat Detail
                            </button>
                        </div>
                    </article>

                    <article class="product">
                        <div class="product-image">
                            <img
                                src="{{ asset('images/products/gantungan-kunci-resin.jpeg') }}"
                                alt="Gantungan Kunci Resin">
                        </div>

                        <div class="product-info">
                            <h3>Gantungan Kunci Resin</h3>
                            <p>Aksesori handmade untuk gantungan kunci.</p>
                            <span class="product-price">Rp15.000</span>

                            <button class="detail-button"
                                onclick="showDetail(2)">
                                Lihat Detail
                            </button>
                        </div>
                    </article>

                    <article class="product">
                        <div class="product-image">
                            <img
                                src="{{ asset('images/products/tote-bag-handmade.jpeg') }}"
                                alt="Tote Bag Handmade">
                        </div>

                        <div class="product-info">
                            <h3>Tote Bag Handmade</h3>
                            <p>Tas handmade yang praktis dan stylish.</p>
                            <span class="product-price">Rp15.000</span>

                            <button class="detail-button"
                                onclick="showDetail(3)">
                                Lihat Detail
                            </button>
                        </div>
                    </article>

                    <article class="product">
                        <div class="product-image">
                            <img
                                src="{{ asset('images/products/hiasan-dinding.jpg') }}"
                                alt="Hiasan Dinding Handmade">
                        </div>

                        <div class="product-info">
                            <h3>Hiasan Dinding Handmade</h3>
                            <p>Hiasan dekoratif yang dibuat dengan tangan.</p>
                            <span class="product-price">Rp35.000</span>

                            <button class="detail-button"
                                onclick="showDetail(4)">
                                Lihat Detail
                            </button>
                        </div>
                    </article>

                    <article class="product">
                        <div class="product-image">
                            <img
                                src="{{ asset('images/products/bucket-bunga-kertas.jpg') }}"
                                alt="Bucket Bunga Kertas">
                        </div>

                        <div class="product-info">
                            <h3>Bucket Bunga Kertas</h3>
                            <p>Rangkaian bunga kertas untuk dekorasi atau hadiah.</p>
                            <span class="product-price">Rp50.000</span>

                            <button class="detail-button"
                                onclick="showDetail(5)">
                                Lihat Detail
                            </button>
                        </div>
                    </article>

                    <article class="product">
                        <div class="product-image">
                            <img
                                src="{{ asset('images/products/gantungan-kunci-manik.png') }}"
                                alt="Gantungan Kunci Manik">
                        </div>

                        <div class="product-info">
                            <h3>Gantungan Kunci Manik</h3>
                            <p>Gantungan kunci dengan hiasan rangkaian manik.</p>
                            <span class="product-price">Rp10.000</span>

                            <button class="detail-button"
                                onclick="showDetail(6)">
                                Lihat Detail
                            </button>
                        </div>
                    </article>

                    <article class="product">
                        <div class="product-image">
                            <img
                                src="{{ asset('images/products/gantungan-kunci-rajut.png') }}"
                                alt="Gantungan Kunci Rajut">
                        </div>

                        <div class="product-info">
                            <h3>Gantungan Kunci Rajut</h3>
                            <p>Gantungan rajut berbentuk karakter lucu.</p>
                            <span class="product-price">Rp25.000</span>

                            <button class="detail-button"
                                onclick="showDetail(7)">
                                Lihat Detail
                            </button>
                        </div>
                    </article>

                </div>
            </section>

            <!-- BAGIAN BAWAH TAMBAHAN -->

            <section class="bottom-section">
                <div class="bottom-heading">
                    <p class="eyebrow">Tentang Ruang Karya</p>

                    <h2>Setiap ide layak untuk dikenal.</h2>

                    <p>
                        Ruang Karya menjadi tempat untuk mengenal
                        berbagai produk kerajinan UMKM mahasiswa
                        dan menghargai kreativitas di balik setiap karya.
                    </p>
                </div>

                <div class="benefit-grid">
                    <article class="benefit-card">
                        <div class="benefit-icon">✿</div>

                        <h3>Karya Buatan Tangan</h3>

                        <p>
                            Mengenal kerajinan yang dibuat dengan
                            kreativitas dan keterampilan mahasiswa.
                        </p>
                    </article>

                    <article class="benefit-card">
                        <div class="benefit-icon">♡</div>

                        <h3>Beragam Produk</h3>

                        <p>
                            Temukan inspirasi aksesori manik-manik,
                            rajutan, hiasan, dan kerajinan lainnya.
                        </p>
                    </article>

                    <article class="benefit-card">
                        <div class="benefit-icon">✧</div>

                        <h3>Kreativitas Mahasiswa</h3>

                        <p>
                            Apresiasi ide kreatif mahasiswa melalui
                            produk-produk UMKM yang ditampilkan.
                        </p>
                    </article>
                </div>

                <div class="bottom-cta">
                    <div>
                        <h2>Temukan karya favoritmu.</h2>

                        <p>
                            Jelajahi katalog dan kenali berbagai
                            kerajinan menarik dari mahasiswa.
                        </p>
                    </div>

                    <a href="#produk" class="button-light">
                        Jelajahi Katalog
                    </a>
                </div>
            </section>
        </main>

        <footer>
            Ruang Karya · Produksi UMKM Kerajinan Mahasiswa
        </footer>
    </div>

    <!-- POPUP DETAIL PRODUK -->

    <div class="modal" id="productModal"
        role="dialog" aria-modal="true"
        aria-labelledby="modalName"
        onclick="if(event.target === this) closeDetail()">

        <div class="modal-content">
            <button class="modal-close"
                onclick="closeDetail()"
                aria-label="Tutup detail">&times;</button>

            <img class="modal-image" id="modalImage" src="" alt="">

            <div class="modal-body">
                <h2 id="modalName"></h2>

                <p class="modal-price" id="modalPrice"></p>

                <p class="modal-label">Deskripsi Produk</p>
                <div class="modal-description" id="modalDescription"></div>

                <p class="modal-label">Bahan Produk</p>
                <div class="modal-material" id="modalMaterial"></div>
            </div>
        </div>
    </div>

    <script>
        const productDetails = [
            {
                name: 'Gelang Manik',
                price: 'Rp15.000',
                image: @json(asset('images/products/gelang-manik.png')),
                description: 'Aksesori handmade dari rangkaian manik dengan warna menarik untuk melengkapi penampilan.',
                material: 'Manik-manik dan tali elastis.'
            },
            {
                name: 'Strap HP Manik-Manik',
                price: 'Rp15.000',
                image: @json(asset('images/products/Strap-HP-Manik-Manik.jpg')),
                description: 'Aksesori handmade untuk HP dengan rangkaian manik yang unik dan berwarna.',
                material: 'Manik-manik, tali penghubung, dan pengait strap.'
            },
            {
                name: 'Gantungan Kunci Resin',
                price: 'Rp15.000',
                image: @json(asset('images/products/gantungan-kunci-resin.png')),
                description: 'Gantungan kunci kreatif dengan hiasan resin yang menarik.',
                material: 'Resin dan ring gantungan kunci.'
            },
            {
                name: 'Tote Bag Handmade',
                price: 'Rp15.000',
                image: @json(asset('images/products/tote-bag-handmade.jpg')),
                description: 'Tas handmade yang praktis untuk membawa barang sehari-hari.',
                material: 'Kain tote bag dan hiasan dekoratif.'
            },
            {
                name: 'Hiasan Dinding Handmade',
                price: 'Rp35.000',
                image: @json(asset('images/products/hiasan-dinding.jpg')),
                description: 'Hiasan dekoratif buatan tangan yang cocok untuk memperindah ruangan.',
                material: 'Bahan kerajinan dekoratif sesuai desain.'
            },
            {
                name: 'Bucket Bunga Kertas',
                price: 'Rp50.000',
                image: @json(asset('images/products/bucket-bunga-kertas.jpg')),
                description: 'Rangkaian bunga kertas yang cocok dijadikan dekorasi atau hadiah.',
                material: 'Kertas bunga, kawat, pita, dan kertas pembungkus.'
            },
            {
                name: 'Gantungan Kunci Manik',
                price: 'Rp10.000',
                image: @json(asset('images/products/gantungan-kunci-manik.png')),
                description: 'Gantungan kunci dengan hiasan rangkaian manik berwarna.',
                material: 'Manik-manik, tali, dan ring gantungan kunci.'
            },
            {
                name: 'Gantungan Kunci Rajut',
                price: 'Rp25.000',
                image: @json(asset('images/products/gantungan-kunci-rajut.png')),
                description: 'Gantungan kunci rajut berbentuk karakter lucu yang dibuat dengan keterampilan tangan.',
                material: 'Benang rajut, isian dakron, dan ring gantungan kunci.'
            }
        ];

        function showDetail(index) {
            const product = productDetails[index];

            if (!product) return;

            document.getElementById('modalName').textContent = product.name;
            document.getElementById('modalPrice').textContent = product.price;
            document.getElementById('modalImage').src = product.image;
            document.getElementById('modalImage').alt = product.name;
            document.getElementById('modalDescription').textContent = product.description;
            document.getElementById('modalMaterial').textContent = product.material;

            document.getElementById('productModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeDetail() {
            document.getElementById('productModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDetail();
            }
        });
    </script>
</body>
</html>
