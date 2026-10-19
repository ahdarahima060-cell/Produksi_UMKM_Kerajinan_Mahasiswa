<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk | Ruang Karya</title>

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
            max-width: 1100px;
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

        .form-card {
            background: white;
            border: 1px solid #e9e9e1;
            border-radius: 10px;
            padding: 28px;
        }

        .section-title {
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 22px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .form-control {
            min-height: 42px;
            border-color: #dfe4dd;
            border-radius: 7px;
            font-size: 14px;
        }

        textarea.form-control {
            min-height: 110px;
        }

        .form-control:focus {
            border-color: #315c49;
            box-shadow: 0 0 0 2px rgba(49, 92, 73, 0.12);
        }

        .upload-area {
            border: 2px dashed #cbd5cb;
            border-radius: 9px;
            background: #fafbf8;
            padding: 22px 18px;
            text-align: center;
        }

        .upload-icon {
            font-size: 35px;
            color: #315c49;
            margin-bottom: 12px;
        }

        .upload-area p {
            font-size: 14px;
            margin-bottom: 6px;
        }

        .upload-area small {
            color: #777;
            font-size: 12px;
        }

        .current-image {
            width: 100%;
            max-width: 250px;
            max-height: 220px;
            object-fit: contain;
            border-radius: 8px;
            margin: 12px auto;
            display: block;
            border: 1px solid #e9e9e1;
            background: white;
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
            .form-card {
                padding: 18px;
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
                        Edit Produk
                    </li>
                </ol>
            </nav>

            <div class="page-title mb-4">
                <h2>Edit Produk</h2>
                <p>Perbarui informasi produk kerajinan UMKM.</p>
            </div>

            <div class="form-card">

                <form action="{{ route('admin.produk.update', $produk->id) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">

                        <!-- Kolom kiri: Informasi produk -->
                        <div class="col-lg-7">
                            <h5 class="section-title">Informasi Produk</h5>

                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">
                                    Nama Produk
                                </label>
                                <input
                                    type="text"
                                    name="nama_produk"
                                    id="nama_produk"
                                    class="form-control"
                                    value="{{ old('nama_produk', $produk->nama_produk) }}"
                                    required>

                                @error('nama_produk')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kategori" class="form-label">
                                    Kategori
                                </label>
                                <input
                                    type="text"
                                    name="kategori"
                                    id="kategori"
                                    class="form-control"
                                    value="{{ old('kategori', $produk->kategori) }}"
                                    placeholder="Contoh: Aksesoris">

                                @error('kategori')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="harga" class="form-label">
                                        Harga (Rp)
                                    </label>
                                    <input
                                        type="number"
                                        name="harga"
                                        id="harga"
                                        class="form-control"
                                        min="0"
                                        step="0.01"
                                        value="{{ old('harga', $produk->harga) }}"
                                        required>

                                    @error('harga')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="stok" class="form-label">
                                        Stok
                                    </label>
                                    <input
                                        type="number"
                                        name="stok"
                                        id="stok"
                                        class="form-control"
                                        min="0"
                                        value="{{ old('stok', $produk->stok) }}"
                                        required>

                                    @error('stok')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">
                                    Deskripsi
                                </label>
                                <textarea
                                    name="deskripsi"
                                    id="deskripsi"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Jelaskan bahan atau keunikan produk...">{{ old('deskripsi', $produk->deskripsi) }}</textarea>

                                @error('deskripsi')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Kolom kanan: Gambar produk -->
                        <div class="col-lg-5">
                            <h5 class="section-title">Gambar Produk</h5>

                            <div class="upload-area">
                                <div class="upload-icon">↑</div>

                                <p class="fw-semibold">Gambar Saat Ini</p>

                                @if ($produk->gambar)
                                    <img
                                        src="{{ asset('storage/' . $produk->gambar) }}"
                                        alt="{{ $produk->nama_produk }}"
                                        class="current-image">

                                    <small class="d-block mb-3">
                                        Pilih gambar baru jika ingin menggantinya.
                                    </small>
                                @else
                                    <p class="text-secondary">
                                        Produk belum memiliki gambar.
                                    </p>
                                @endif

                                <label for="gambar" class="form-label d-block text-start">
                                    Ganti Gambar
                                </label>

                                <input
                                    type="file"
                                    name="gambar"
                                    id="gambar"
                                    class="form-control"
                                    accept="image/jpeg,image/png,image/webp">

                                <small class="d-block mt-2">
                                    Format JPG, JPEG, PNG, atau WEBP.
                                </small>

                                @error('gambar')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <!-- Tombol aksi -->
                    <div class="form-actions">
                        <a href="{{ route('admin.produk.index') }}"
                           class="btn btn-outline-secondary">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-green">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </main>

</body>
</html>