<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk | Ruang Karya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        rel="stylesheet">

    <style>
        body {
            background: #f7f5ef;
            color: #263b32;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background: #315b46;
            color: white;
            min-height: 100vh;
            padding: 25px 18px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px;
            margin: 8px 0;
            border-radius: 8px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #47745d;
        }

        .content {
            padding: 35px;
        }

        .panel {
            background: white;
            border: 1px solid #e9e7df;
            border-radius: 12px;
            padding: 24px;
        }

        .btn-green {
            background: #315b46;
            color: white;
        }

        .btn-green:hover {
            background: #254635;
            color: white;
        }

        .table th {
            background: #e8efe9;
            color: #315b46;
            white-space: nowrap;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .brand-desc {
            color: #d6e2d9;
            font-size: 13px;
            margin-bottom: 35px;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <aside class="col-md-2 sidebar">
                <div class="brand">
                    <i class="fa-solid fa-leaf me-2"></i>Ruang Karya
                </div>

                <div class="brand-desc">
                    Sistem Produksi UMKM Mahasiswa
                </div>

                <hr>

                <a href="{{ route('admin.dashboard') }}">⌂ Dashboard</a>
                <a href="{{ route('admin.produk.index') }}" class="active">▣ Kelola Produk</a>

                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100">
                        Logout
                    </button>
                </form>
            </aside>

            <main class="col-md-10 content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold">Kelola Produk</h2>
                        <p class="text-secondary">
                            Tambah, lihat, ubah, dan hapus produk kerajinan.
                        </p>
                    </div>

                    <a href="{{ route('admin.produk.create') }}"
                        class="btn btn-green">
                        + Tambah Produk
                    </a>
                </div>

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    Periksa kembali data yang kamu masukkan.
                </div>
                @endif

                <div class="panel">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($produks as $produk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        @if ($produk->gambar)
                                        <img
                                            src="{{ asset('storage/' . $produk->gambar) }}"
                                            alt="{{ $produk->nama_produk }}"
                                            width="65"
                                            height="65"
                                            style="object-fit: cover; border-radius: 8px;">
                                        @else
                                        <span class="text-muted">Belum ada gambar</span>
                                        @endif
                                    </td>

                                    <td>{{ $produk->nama_produk }}</td>
                                    <td>{{ $produk->kategori ?? '-' }}</td>

                                    <td>
                                        Rp{{ number_format($produk->harga, 0, ',', '.') }}
                                    </td>

                                    <td>{{ $produk->stok }}</td>

                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.produk.edit', $produk) }}"
                                                class="btn btn-warning btn-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.produk.destroy', $produk) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                   <td colspan="7" class="text-center py-4">
                                        Belum ada data produk.
                                        Silakan klik Tambah Produk.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <a href="{{ route('admin.dashboard') }}"
                    class="btn btn-outline-secondary mt-3">
                    ← Kembali ke Dashboard
                </a>
            </main>
        </div>
    </div>

</body>

</html>