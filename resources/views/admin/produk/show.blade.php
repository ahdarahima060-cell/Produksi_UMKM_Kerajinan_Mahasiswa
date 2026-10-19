<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk | Ruang Karya</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f7f5ef;
            color: #26352d;
            font-family: Arial, sans-serif;
        }

        .header {
            background: #315c49;
            color: white;
            padding: 18px 5%;
        }

        .header h3 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 13px;
            color: #e6eee8;
        }

        .main-content {
            max-width: 1000px;
            margin: auto;
        }

        .breadcrumb {
            font-size: 13px;
        }

        .breadcrumb a {
            color: #315c49;
            text-decoration: none;
        }

        .page-title h2 {
            font-size: 26px;
            font-weight: 600;
        }

        .page-title p {
            color: #777;
            font-size: 14px;
        }

        .detail-card {
            background: white;
            border: 1px solid #e9e9e1;
            border-radius: 10px;
            padding: 28px;
        }

        .product-image {
            width: 100%;
            height: 350px;
            object-fit: contain;
            background: #fafbf8;
            border: 1px solid #e9e9e1;
            border-radius: 9px;
        }

        .no-image {
            width: 100%;
            height: 350px;
            background: #fafbf8;
            border: 1px dashed #cbd5cb;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
            font-size: 14px;
        }

        .product-name {
            font-size: 25px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .category {
            display: inline-block;
            background: #e5eee7;
            color: #315c49;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .price {
            color: #315c49;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .info-label {
            color: #777;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 15px;
            font-weight: 600;
        }

        .info-box {
            background: #fafbf8;
            border: 1px solid #e9e9e1;
            border-radius: 8px;
            padding: 14px;
            margin-bottom: 18px;
        }

        .description {
            font-size: 14px;
            line-height: 1.7;
            white-space: pre-line;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding-top: 20px;
            margin-top: 25px;
            border-top: 1px solid #eeeeea;
        }

        .form-actions .btn {
            padding: 9px 18px;
            border-radius: 7px;
            font-size: 14px;
        }

        .btn-green {
            background: #315c49;
            color: white;
            border: 1px solid #315c49;
        }

        .btn-green:hover {
            background: #254635;
            color: white;
        }

        @media (max-width: 576px) {
            .detail-card {
                padding: 18px;
            }

            .product-image,
            .no-image {
                height: 250px;
            }

            .product-name {
                font-size: 22px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <header class="header">
        <h3>Ruang Karya</h3>
        <p>Kelola Produk Kerajinan</p>
    </header>

    <main class="container py-4">
        <div class="main-content">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.produk.index') }}">Produk</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Detail Produk
                    </li>
                </ol>
            </nav>

            <div class="page-title mb-4">
                <h2>Detail Produk</h2>
                <p>Informasi lengkap produk kerajinan UMKM.</p>
            </div>

            <div class="detail-card">
                <div class="row g-4">

                    <!-- Gambar produk -->
                    <div class="col-lg-5">
                        @if ($produk->gambar)
                            <img
                                src="{{ asset('storage/' . $produk->gambar) }}"
                                alt="{{ $produk->nama_produk }}"
                                class="product-image">
                        @else
                            <div class="no-image">
                                Gambar produk belum tersedia
                            </div>
                        @endif
                    </div>

                    <!-- Informasi produk -->
                    <div class="col-lg-7">
                        <h3 class="product-name">
                            {{ $produk->nama_produk }}
                        </h3>

                        @if ($produk->kategori)
                            <span class="category">
                                {{ $produk->kategori }}
                            </span>
                        @endif

                        <div class="price">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </div>

                        <div class="info-box">
                            <div class="info-label">Stok Produk</div>
                            <div class="info-value">
                                {{ $produk->stok }} unit
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="info-label">Deskripsi Produk</div>

                            <div class="description">
                                {{ $produk->deskripsi ?: 'Belum ada deskripsi produk.' }}
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Tombol aksi -->
                <div class="form-actions">
                    <a href="{{ route('admin.produk.index') }}"
                       class="btn btn-outline-secondary">
                        Kembali
                    </a>

                    <a href="{{ route('admin.produk.edit', $produk->id) }}"
                       class="btn btn-green">
                        Edit Produk
                    </a>
                </div>
            </div>

        </div>
    </main>

</body>
</html>