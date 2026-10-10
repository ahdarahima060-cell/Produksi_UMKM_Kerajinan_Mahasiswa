```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Ruang Karya</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          rel="stylesheet">

    <style>
        :root {
            --hijau: #315c49;
            --hijau-muda: #e8f0e9;
            --krem: #f7f5ef;
            --teks: #26352d;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--krem);
            color: var(--teks);
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--hijau);
            color: white;
            padding: 28px 18px;
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

        .menu-label {
            font-size: 11px;
            color: #c6d6cc;
            letter-spacing: 1px;
            margin: 22px 12px 10px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            margin-bottom: 7px;
            border-radius: 8px;
            text-decoration: none;
            color: #f2f6f3;
            font-size: 14px;
        }

        .menu-link.active,
        .menu-link:hover {
            background: #47745d;
            color: white;
        }

        .menu-link i {
            width: 18px;
        }

        .main-content {
            margin-left: 250px;
            padding: 32px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 32px;
        }

        .topbar h1 {
            font-size: 27px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .muted {
            color: #7a857e;
            font-size: 14px;
        }

        .admin-badge {
            background: white;
            padding: 10px 15px;
            border-radius: 10px;
            border: 1px solid #e5e7df;
            font-size: 13px;
        }

        .welcome-card {
            background: var(--hijau);
            color: white;
            padding: 28px;
            border-radius: 14px;
            margin-bottom: 28px;
        }

        .welcome-card h2 {
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .welcome-card p {
            color: #e0ebe3;
            margin: 0;
            line-height: 1.7;
        }

        .section-title {
            font-size: 19px;
            font-weight: bold;
            margin-bottom: 18px;
        }

        .feature-card {
            height: 100%;
            background: white;
            padding: 23px;
            border: 1px solid #e9e9e1;
            border-radius: 12px;
        }

        .feature-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: var(--hijau-muda);
            color: var(--hijau);
            font-size: 20px;
            margin-bottom: 18px;
        }

        .feature-card h3 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 13px;
            color: #7a857e;
            line-height: 1.7;
            margin: 0;
        }

        .info-card {
            background: white;
            border: 1px solid #e9e9e1;
            border-radius: 12px;
            padding: 23px;
            margin-top: 25px;
        }

        .logout-btn {
            width: 100%;
            margin-top: 28px;
            padding: 11px;
            border: 1px solid #91aa9b;
            border-radius: 8px;
            background: transparent;
            color: white;
        }

        .logout-btn:hover {
            background: #47745d;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                min-height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                padding: 22px 16px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">
            <i class="fa-solid fa-leaf me-2"></i>Ruang Karya
        </div>

        <div class="brand-desc">
            Sistem Produksi UMKM Mahasiswa
        </div>

        <div class="menu-label">MENU UTAMA</div>

        <a href="{{ route('admin.dashboard') }}"
           class="menu-link active">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <div class="menu-label">PENGELOLAAN UMKM</div>

        <div class="menu-link">
            <i class="fa-solid fa-box"></i>
            Kelola Produk
        </div>

        <div class="menu-link">
            <i class="fa-solid fa-cart-shopping"></i>
            Proses Pesanan
        </div>

        <div class="menu-link">
            <i class="fa-solid fa-hammer"></i>
            Pencatatan Produksi & Penjualan
        </div>

        <div class="menu-link">
            <i class="fa-solid fa-boxes-stacked"></i>
            Stok Otomatis
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket me-2"></i>
                Logout
            </button>
        </form>
    </aside>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h1>Dashboard Admin</h1>
                <div class="muted">
                    Selamat datang di sistem pengelolaan UMKM kerajinan mahasiswa.
                </div>
            </div>

            <div class="admin-badge">
                <i class="fa-solid fa-user-shield me-2"></i>
                {{ auth()->user()->name }}
            </div>
        </div>

        <section class="welcome-card">
            <h2>Selamat datang, {{ auth()->user()->name }}!</h2>
            <p>
                Kelola produk kerajinan, proses pesanan, catat produksi dan
                penjualan, serta pantau stok melalui satu halaman.
            </p>
        </section>

        <h2 class="section-title">Pengelolaan UMKM</h2>

        <div class="row g-3">

            <div class="col-md-6 col-xl-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-box"></i>
                    </div>
                    <h3>Kelola Produk</h3>
                    <p>
                        Mengelola informasi produk kerajinan, harga, dan data produk.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <h3>Proses Pesanan</h3>
                    <p>
                        Melihat dan mengelola pesanan yang masuk dari pembeli.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <h3>Produksi & Penjualan</h3>
                    <p>
                        Mencatat jumlah produk yang dibuat dan jumlah yang terjual.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <h3>Stok Otomatis</h3>
                    <p>
                        Memantau persediaan produk berdasarkan catatan produksi
                        dan penjualan.
                    </p>
                </div>
            </div>

        </div>

        <section class="info-card">
            <h2 class="section-title">Informasi Sistem</h2>
            <p class="muted mb-0">
                Gunakan menu pengelolaan untuk mengatur aktivitas UMKM kerajinan
                mahasiswa. Fitur akan dihubungkan secara bertahap sesuai timeline
                pengembangan project.
            </p>
        </section>

    </main>

</body>
</html>
```