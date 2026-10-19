
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Produksi | Ruang Karya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f7f5ef; color: #26352d; font-family: Arial, sans-serif; }
        .sidebar { background: #315c49; color: white; min-height: 100vh; padding: 25px 18px; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 12px; margin-bottom: 8px; border-radius: 8px; }
        .sidebar a:hover, .sidebar a.active { background: #47745d; }
        .content { padding: 32px; }
        .panel { background: white; border: 1px solid #e9e9e1; border-radius: 12px; padding: 24px; }
        .btn-green { background: #315c49; color: white; }
        .btn-green:hover { background: #254635; color: white; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <aside class="col-md-2 sidebar">
            <h4 class="fw-bold">Ruang Karya</h4>
            <p class="small">Sistem Produksi UMKM Mahasiswa</p>
            <hr>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.produk.index') }}">Kelola Produk</a>
            <a href="{{ route('admin.produksi.index') }}" class="active">Data Produksi</a>

            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">Logout</button>
            </form>
        </aside>

        <main class="col-md-10 content">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <h2 class="fw-bold">Data Produksi</h2>
                    <p class="text-secondary">Catat dan kelola hasil produksi kerajinan.</p>
                </div>
                <a href="{{ route('admin.produksi.create') }}" class="btn btn-green">
                    + Tambah Produksi
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">Ada data yang perlu diperbaiki.</div>
            @endif

            <div class="panel">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Produksi</th>
                                <th>Tanggal Produksi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produksis as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->produk->nama_produk ?? 'Produk tidak tersedia' }}</td>
                                    <td>{{ $item->jumlah_produksi }} buah</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_produksi)->format('d-m-Y') }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('admin.produksi.edit', $item) }}"
                                           class="btn btn-warning btn-sm">Edit</a>

                                        <form action="{{ route('admin.produksi.destroy', $item) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus catatan produksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        Belum ada catatan produksi. Klik Tambah Produksi untuk memulai.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary mt-3">
                ← Kembali ke Dashboard
            </a>
        </main>
    </div>
</div>
</body>
</html>
