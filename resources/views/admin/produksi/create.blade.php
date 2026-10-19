
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Produksi | Ruang Karya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f7f5ef; color: #26352d; font-family: Arial, sans-serif; }
        .header { background: #315c49; color: white; padding: 24px; }
        .form-card { background: white; border: 1px solid #e9e9e1; border-radius: 12px; padding: 28px; }
        .btn-green { background: #315c49; color: white; }
        .btn-green:hover { background: #254635; color: white; }
    </style>
</head>
<body>
<header class="header">
    <h3>Ruang Karya</h3>
    <p class="mb-0">Pencatatan Produksi Kerajinan</p>
</header>

<main class="container py-4">
    <h2 class="fw-bold">Tambah Produksi</h2>
    <p class="text-secondary mb-4">Masukkan hasil produksi yang telah dibuat.</p>

    <div class="form-card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.produksi.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="produk_id" class="form-label">Pilih Produk</label>
                <select name="produk_id" id="produk_id" class="form-select" required>
                    <option value="">-- Pilih produk --</option>
                    @foreach ($produks as $produk)
                        <option value="{{ $produk->id }}"
                            {{ old('produk_id') == $produk->id ? 'selected' : '' }}>
                            {{ $produk->nama_produk }}
                        </option>
                    @endforeach
                </select>
                @if ($produks->isEmpty())
                    <small class="text-danger">Belum ada produk. Tambahkan produk terlebih dahulu.</small>
                @endif
            </div>

            <div class="mb-3">
                <label for="jumlah_produksi" class="form-label">Jumlah Produksi (buah)</label>
                <input type="number" name="jumlah_produksi" id="jumlah_produksi"
                       class="form-control" min="1" value="{{ old('jumlah_produksi') }}" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_produksi" class="form-label">Tanggal Produksi</label>
                <input type="date" name="tanggal_produksi" id="tanggal_produksi"
                       class="form-control" value="{{ old('tanggal_produksi') }}" required>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control"
                          rows="3">{{ old('keterangan') }}</textarea>
            </div>

            <button type="submit" class="btn btn-green">Simpan Produksi</button>
            <a href="{{ route('admin.produksi.index') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
    </div>
</main>
</body>
</html>
