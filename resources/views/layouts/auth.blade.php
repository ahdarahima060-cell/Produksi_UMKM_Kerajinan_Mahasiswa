<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f5f6f2">
    <title>@yield('title') — Ruang Karya</title>
    <style>
        :root {
            color-scheme: light;
            --ink: #202923;
            --muted: #707a73;
            --green: #315b46;
            --green-dark: #264633;
            --line: #e6e9e3;
            --paper: #f5f6f2;
        }

        * { box-sizing: border-box; }
        body {
            display: grid;
            min-height: 100vh;
            margin: 0;
            padding: 32px 20px;
            place-items: center;
            background:
                radial-gradient(ellipse at 5% 5%, #e7ede5 0, transparent 34%),
                var(--paper);
            color: var(--ink);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        a { color: var(--green); text-underline-offset: 3px; }
        .auth-card {
            display: grid;
            width: min(920px, 100%);
            min-height: 560px;
            grid-template-columns: .88fr 1.12fr;
            overflow: hidden;
            border: 1px solid #e9ebe5;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 24px 70px #24352812, 0 2px 8px #24352808;
        }
        .auth-aside {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            padding: 38px;
            background: var(--green);
            color: #fff;
        }
        .auth-aside::before, .auth-aside::after {
            position: absolute;
            right: -100px;
            bottom: 75px;
            width: 290px;
            height: 290px;
            border: 1px solid #ffffff2b;
            border-radius: 50%;
            content: "";
        }
        .auth-aside::after { right: -60px; bottom: 35px; width: 210px; height: 210px; }
        .brand { position: relative; z-index: 1; display: flex; align-items: center; gap: 11px; font-weight: 700; letter-spacing: -.03em; }
        .brand-mark {
            display: grid;
            width: 36px;
            height: 36px;
            place-items: center;
            border: 1px solid #ffffff5c;
            border-radius: 11px;
            font-family: Georgia, serif;
            font-size: 21px;
        }
        .aside-copy { position: relative; z-index: 1; max-width: 310px; margin: 0 0 12px; }
        .aside-copy h2 { margin: 0 0 14px; font-family: Georgia, "Times New Roman", serif; font-size: 36px; font-weight: 400; letter-spacing: -.04em; line-height: 1.1; }
        .aside-copy p { margin: 0; color: #ffffffc7; font-size: 14px; line-height: 1.8; }
        .aside-note { position: relative; z-index: 1; margin-top: 28px; color: #ffffffa8; font-size: 12px; }
        .auth-content { display: flex; align-items: center; justify-content: center; padding: 52px 64px; }
        .form-wrap { width: min(100%, 360px); }
        .form-eyebrow { margin: 0 0 10px; color: var(--green); font-size: 12px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; }
        h1 { margin: 0; font-size: 29px; font-weight: 650; letter-spacing: -.045em; }
        .form-intro { margin: 10px 0 28px; color: var(--muted); font-size: 14px; line-height: 1.6; }
        .field { margin-top: 18px; }
        label { display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; }
        input {
            width: 100%;
            min-height: 46px;
            padding: 0 13px;
            border: 1px solid #dfe4dd;
            border-radius: 7px;
            outline: none;
            background: #fff;
            color: var(--ink);
            font: inherit;
            font-size: 14px;
            transition: border-color .16s ease, box-shadow .16s ease;
        }
        input::placeholder { color: #a0a8a1; }
        input:focus { border-color: #658a70; box-shadow: 0 0 0 3px #315b461c; }
        input[aria-invalid="true"] { border-color: #bd4b43; }
        .field-error { margin: 7px 0 0; color: #b42318; font-size: 12px; }
        .alert {
            margin: 18px 0;
            padding: 12px 14px;
            border: 1px solid #f0d4d1;
            border-radius: 7px;
            background: #fff5f4;
            color: #9b2c25;
            font-size: 13px;
            line-height: 1.5;
        }
        
        .alert-success {
            border-color: #b7dfbf;
            background: #e8f5e9;
            color: #256b3b;
        }

        .alert-error {
            border-color: #f0d4d1;
            background: #fff5f4;
            color: #9b2c25;
        }

        .submit-button {
            width: 100%;
            min-height: 48px;
            margin-top: 25px;
            border: 0;
            border-radius: 7px;
            background: var(--green);
            color: #fff;
            cursor: pointer;
            font: inherit;
            font-size: 14px;
            font-weight: 650;
            transition: background .16s ease, transform .16s ease;
        }
        .submit-button:hover { transform: translateY(-1px); background: var(--green-dark); }
        .form-foot { margin: 24px 0 0; color: var(--muted); font-size: 13px; text-align: center; }
        .form-foot a { font-weight: 650; text-decoration: none; }
        .form-foot a:hover { text-decoration: underline; }
        .dashboard-copy { margin: 26px 0; color: var(--muted); line-height: 1.7; }
        .role-badge { display: inline-flex; margin-top: 4px; padding: 7px 11px; border-radius: 99px; background: #edf3ed; color: var(--green); font-size: 12px; font-weight: 700; }
        .logout-button {
            min-height: 44px;
            padding: 0 18px;
            border: 1px solid var(--line);
            border-radius: 7px;
            background: #fff;
            color: var(--ink);
            cursor: pointer;
            font: inherit;
            font-size: 13px;
            font-weight: 600;
        }
        .logout-button:hover { border-color: #c8d2c8; background: #f8faf7; }

        @media (max-width: 700px) {
            body { padding: 18px 14px; }
            .auth-card { max-width: 480px; min-height: 0; grid-template-columns: 1fr; border-radius: 14px; }
            .auth-aside { min-height: 190px; padding: 24px; }
            .aside-copy { margin-top: 30px; }
            .aside-copy h2 { margin-bottom: 7px; font-size: 27px; }
            .aside-copy p { max-width: 340px; font-size: 13px; }
            .aside-note { display: none; }
            .auth-content { padding: 32px 24px 36px; }
            .form-intro { margin-bottom: 22px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; transition: none !important; }
        }
    </style>
</head>
<body>
    <main class="auth-card">
        <aside class="auth-aside">
            <a class="brand" href="{{ url('/') }}" aria-label="Ruang Karya, halaman utama">
                <span class="brand-mark" aria-hidden="true">r</span>
                <span>ruang karya</span>
            </a>
            <div class="aside-copy">
                <h2>Karya baik tumbuh dari proses yang terjaga.</h2>
                <p>Kelola perjalanan produksi dan penjualan kerajinan dalam satu ruang sederhana.</p>
            </div>
            <span class="aside-note">Produksi UMKM Kerajinan Mahasiswa</span>
        </aside>
        <section class="auth-content">
            <div class="form-wrap">
                @yield('content')
            </div>
        </section>
    </main>
</body>
</html>
