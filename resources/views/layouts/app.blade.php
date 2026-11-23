<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - TitipKirim</title>
    <style>
        :root {
            --green: #285943;
            --green2: #3f7659;
            --cream: #f6f2e8;
            --white: #fff;
            --ink: #26352d;
            --muted: #78847c;
            --line: #e7e8df;
        }
        * { box-sizing: border-box; }
        body { margin: 0; background: var(--cream); font-family: Arial, sans-serif; color: var(--ink); }
        .sidebar { position: fixed; inset: 0 auto 0 0; width: 255px; background: var(--green); padding: 26px 16px; color: white; overflow-y: auto; }
        .brand { font-size: 23px; font-weight: 800; margin: 0 10px 4px; color: white; text-decoration: none; display: block; }
        .tagline { font-size: 12px; color: #d7e5d9; margin: 0 10px 26px; }
        .nav a { display: block; color: #e8f0e9; text-decoration: none; padding: 11px 14px; border-radius: 10px; margin: 4px 0; font-size: 14px; }
        .nav a:hover, .nav a.active { background: #ffffff24; font-weight: 700; color: #fff; }
        .nav .section { font-size: 11px; text-transform: uppercase; letter-spacing: 0.6px; color: #bcd0c1; margin: 20px 12px 6px; }
        .main { margin-left: 255px; padding: 30px; max-width: 1500px; }
        .top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 12px; flex-wrap: wrap; }
        .top h1 { font-size: 25px; margin: 0; }
        .user-badge { font-size: 13px; background: white; padding: 8px 14px; border-radius: 99px; border: 1px solid var(--line); color: var(--ink); font-weight: 700; }
        .card { background: white; border: 1px solid var(--line); border-radius: 16px; padding: 22px; margin-bottom: 18px; box-shadow: 0 4px 16px #26352d0d; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 16px; margin-bottom: 18px; }
        .stat small { color: var(--muted); font-size: 13px; }
        .stat strong { display: block; font-size: 26px; margin-top: 6px; color: var(--green); }
        .btn { display: inline-block; background: var(--green); color: white; text-decoration: none; border: 0; border-radius: 9px; padding: 10px 15px; cursor: pointer; font: inherit; font-size: 14px; }
        .btn:hover { background: var(--green2); }
        .btn.light { background: #eaf1eb; color: var(--green); }
        .btn.danger { background: #a94442; }
        .btn.sm { padding: 7px 11px; font-size: 13px; }
        input, select, textarea { width: 100%; padding: 11px; border: 1px solid #d9ded8; border-radius: 8px; margin: 6px 0 14px; font: inherit; background: #fff; }
        label { font-size: 13px; font-weight: 700; display: block; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid var(--line); font-size: 14px; }
        th { color: var(--muted); font-weight: 700; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 99px; font-size: 12px; font-weight: 700; background: #eaf1eb; color: var(--green); }
        .badge.warn { background: #fdf3dc; color: #8a6212; }
        .badge.danger { background: #fbeaea; color: #a94442; }
        .alert { padding: 12px 16px; border-radius: 10px; background: #e5f2e8; color: #285943; margin-bottom: 16px; border: 1px solid #c5e1cc; font-weight: 700; }
        .error { color: #a94442; font-size: 13px; }
        .actions { display: flex; gap: 8px; flex-wrap: wrap; align-items: center; }
        .grid-2 { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px; }
        @media (max-width: 850px) {
            .sidebar { position: static; width: auto; }
            .main { margin: 0; padding: 16px; }
            .grid-2, .grid-3 { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    @php $role = auth()->user()->role; @endphp
    <aside class="sidebar">
        <a href="{{ route('home') }}" class="brand">TitipKirim</a>
        <p class="tagline">Titip Barang Lewat Perjalanan</p>

        <nav class="nav">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard {{ ucfirst($role) }}
            </a>

            @if($role === 'pengirim')
                <div class="section">Menu Pengirim</div>
                <a href="{{ route('perjalanan.index') }}" class="{{ request()->routeIs('perjalanan.index') ? 'active' : '' }}">Cari Perjalanan</a>
                <a href="{{ route('titipan.tracking') }}" class="{{ request()->routeIs('titipan.tracking') ? 'active' : '' }}">Status & Pelacakan</a>
                <a href="{{ route('titipan.payments') }}" class="{{ request()->routeIs('titipan.payments') ? 'active' : '' }}">Pembayaran</a>
                <a href="{{ route('titipan.index') }}" class="{{ request()->routeIs('titipan.index') ? 'active' : '' }}">Riwayat Titipan</a>
            @elseif($role === 'traveler')
                <div class="section">Menu Traveler</div>
                <a href="{{ route('perjalanan.create') }}" class="{{ request()->routeIs('perjalanan.create') ? 'active' : '' }}">Tambah Perjalanan</a>
                <a href="{{ route('perjalanan.mine') }}" class="{{ request()->routeIs('perjalanan.mine') ? 'active' : '' }}">Perjalanan Saya</a>
                <a href="{{ route('titipan.incoming') }}" class="{{ request()->routeIs('titipan.incoming') ? 'active' : '' }}">Titipan Masuk</a>
                <a href="{{ route('titipan.updates') }}" class="{{ request()->routeIs('titipan.updates') ? 'active' : '' }}">Update Pengiriman</a>
            @elseif($role === 'admin')
                <div class="section">Pengelolaan Admin</div>
                <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">Manajemen Pengguna</a>
                <a href="{{ route('admin.trips') }}" class="{{ request()->routeIs('admin.trips') ? 'active' : '' }}">Manajemen Perjalanan</a>
                <a href="{{ route('admin.shipments') }}" class="{{ request()->routeIs('admin.shipments') ? 'active' : '' }}">Manajemen Titipan</a>
                <a href="{{ route('admin.transactions') }}" class="{{ request()->routeIs('admin.transactions') ? 'active' : '' }}">Laporan Transaksi</a>
            @endif

            <div class="section">Akun</div>
            <a href="{{ route('home') }}">Halaman Beranda</a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Keluar</a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}">@csrf</form>
        </nav>
    </aside>

    <main class="main">
        <header class="top">
            <h1>@yield('heading', 'Dashboard')</h1>
            <div class="user-badge">{{ auth()->user()->name }} • {{ ucfirst($role) }}</div>
        </header>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="card error">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>