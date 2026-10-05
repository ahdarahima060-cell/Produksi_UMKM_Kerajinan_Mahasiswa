<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ruang Karya — Produksi UMKM</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f7f7f2; color: #202923; font-family: Arial, sans-serif; }
        a { color: inherit; text-decoration: none; }
        .container { width: min(100% - 40px, 1040px); margin: 0 auto; }
        header { display: flex; align-items: center; justify-content: space-between; padding: 20px 0; border-bottom: 1px solid #e5e7df; }
        .brand { font-size: 19px; font-weight: 700; }
        nav { display: flex; align-items: center; gap: 18px; font-size: 14px; }
        nav a:last-child, .button { padding: 10px 15px; border-radius: 6px; background: #315b46; color: white; }
        .hero { display: flex; align-items: center; justify-content: space-between; gap: 40px; padding: 64px 0 52px; }
        .hero-copy { max-width: 600px; }
        .eyebrow { margin: 0 0 14px; color: #315b46; font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
        h1 { margin: 0; font-family: Georgia, serif; font-size: clamp(38px, 6vw, 58px); font-weight: 400; line-height: 1.12; }
        .hero-copy > p:not(.eyebrow) { max-width: 520px; margin: 18px 0 22px; color: #68746d; line-height: 1.7; }
        .hero-art { display: grid; width: 210px; height: 210px; flex: 0 0 210px; place-items: center; border-radius: 50%; background: #e6eadf; color: #315b46; font-size: 74px; }
        .section { padding: 28px 0 56px; border-top: 1px solid #e5e7df; }
        h2 { margin: 0 0 7px; font-family: Georgia, serif; font-size: 30px; font-weight: 400; }
        .section-intro { margin: 0 0 20px; color: #68746d; font-size: 14px; }
        .products { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
        .product { overflow: hidden; border: 1px solid #e5e7df; border-radius: 8px; background: #fff; }
        .product-image { height: 135px; overflow: hidden; background: #e9e6dc; }
        .product-image img { display: block; width: 100%; height: 100%; object-fit: cover; }
        .product:nth-child(2) .product-image { background: #e1e9df; }
        .product:nth-child(3) .product-image { background: #eee3df; }
        .product:nth-child(4) .product-image { background: #e7e7dd; }
        .product-info { padding: 13px; }
        .product-info h3 { margin: 0 0 5px; font-size: 15px; }
        .product-info p { margin: 0; color: #68746d; font-size: 12px; line-height: 1.5; }
        .note { margin-top: 16px; color: #68746d; font-size: 12px; }
        footer { padding: 17px 0; border-top: 1px solid #e5e7df; color: #68746d; font-size: 12px; }
        @media (max-width: 650px) {
            .hero { padding: 44px 0 36px; }
            .hero-art { width: 115px; height: 115px; flex-basis: 115px; font-size: 42px; }
            .products { grid-template-columns: repeat(2, 1fr); gap: 12px; }
        }
        @media (max-width: 430px) {
            .container { width: calc(100% - 28px); }
            .brand { font-size: 16px; }
            nav { gap: 10px; font-size: 12px; }
            nav a:last-child { padding: 9px 10px; }
            .hero { align-items: flex-start; gap: 16px; }
            .hero-art { width: 72px; height: 72px; flex-basis: 72px; font-size: 28px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a class="brand" href="{{ url('/') }}">Ruang Karya</a>
            <nav aria-label="Navigasi akun">
                <a href="{{ route('login') }}">Masuk</a>
                <a href="{{ route('register') }}">Daftar</a>
            </nav>
        </header>

        <main>
            <section class="hero">
                <div class="hero-copy">
                    <p class="eyebrow">Kerajinan UMKM Mahasiswa</p>
                    <h1>Setiap karya punya cerita.</h1>
                    <p>Lihat berbagai contoh kerajinan buatan mahasiswa. Halaman ini hanya untuk melihat karya, belum untuk melakukan pembelian.</p>
                    <a class="button" href="#produk">Lihat contoh produk</a>
                </div>
                <div class="hero-art" aria-hidden="true">✿</div>
            </section>

            <section class="section" id="produk">
                <h2>Contoh kerajinan</h2>
                <p class="section-intro">Beberapa ide karya dari UMKM mahasiswa.</p>

                <div class="products">
                    <article class="product">
                        <div class="product-image">
                            <img src="{{ asset('images/products/gelang-manik.png') }}" alt="Gelang manik">
                        </div>
                        <div class="product-info">
                            <h3>Gelang Manik</h3>
                            <p>Aksesori handmade dari rangkaian manik.</p>
                        </div>
                    </article>
                    <article class="product">
                        <div class="product-image">
                            <img src="{{ asset('images/products/hiasan-dinding.jpg') }}" alt="Hiasan dinding handmade">
                        </div>
                        <div class="product-info">
                            <h3>Hiasan Dinding Handmade</h3>
                            <p>Hiasan dekoratif yang dibuat dengan tangan.</p>
                        </div>
                    </article>
                    <article class="product">
                        <div class="product-image">
                            <img src="{{ asset('images/products/bucket-bunga-kertas.jpg') }}" alt="Bucket bunga kertas">
                        </div>
                        <div class="product-info">
                            <h3>Bucket Bunga Kertas</h3>
                            <p>Rangkaian bunga kertas untuk dekorasi atau hadiah.</p>
                        </div>
                    </article>
                    <article class="product">
                        <div class="product-image">
                            <img src="{{ asset('images/products/gantungan-kunci-manik.png') }}" alt="Gantungan kunci manik">
                        </div>
                        <div class="product-info">
                            <h3>Gantungan Kunci Manik</h3>
                            <p>Gantungan kunci dengan hiasan rangkaian manik.</p>
                        </div>
                    </article>
                    <article class="product">
                        <div class="product-image">
                            <img src="{{ asset('images/products/gantungan-kunci-rajut.png') }}" alt="Gantungan kunci rajut">
                        </div>
                        <div class="product-info">
                            <h3>Gantungan Kunci Rajut</h3>
                            <p>Gantungan rajut berbentuk karakter lucu.</p>
                        </div>
                    </article>
                </div>
            </section>
        </main>

        <footer>Ruang Karya · Produksi UMKM Kerajinan Mahasiswa</footer>
    </div>
</body>
</html>
