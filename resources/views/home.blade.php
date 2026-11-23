<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TitipKirim - Titip Barang Lewat Perjalanan</title>
    <style>
        :root {
            --green: #285943;
            --green2: #3f7659;
            --cream: #f6f2e8;
            --ink: #26352d;
            --muted: #5c6b62;
            --line: #e2e4da;
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: var(--cream); color: var(--ink); }
        header { background: #fff; border-bottom: 1px solid var(--line); padding: 18px 8%; display: flex; justify-content: space-between; align-items: center; }
        .brand { font-size: 24px; font-weight: 800; color: var(--green); text-decoration: none; }
        .nav-btns { display: flex; gap: 10px; }
        .btn { display: inline-block; background: var(--green); color: #fff; text-decoration: none; padding: 11px 18px; border-radius: 10px; font-weight: 700; font-size: 14px; }
        .btn:hover { background: var(--green2); }
        .btn.light { background: #eaf1eb; color: var(--green); }
        .hero { padding: 70px 8% 55px; display: grid; grid-template-columns: 1.2fr 1fr; gap: 36px; align-items: center; }
        .hero h1 { font-size: 40px; line-height: 1.2; margin: 0 0 16px; color: var(--green); }
        .hero p { font-size: 16px; line-height: 1.6; color: var(--muted); margin: 0 0 26px; }
        .hero-card { background: #fff; border: 1px solid var(--line); border-radius: 20px; padding: 26px; box-shadow: 0 8px 24px #26352d0d; }
        .section { padding: 50px 8%; }
        .section h2 { text-align: center; font-size: 28px; color: var(--green); margin: 0 0 10px; }
        .section p.sub { text-align: center; color: var(--muted); margin: 0 0 34px; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .card { background: #fff; border: 1px solid var(--line); border-radius: 16px; padding: 24px; }
        .step-num { display: inline-block; width: 32px; height: 32px; line-height: 32px; text-align: center; border-radius: 50%; background: var(--green); color: #fff; font-weight: 700; margin-bottom: 12px; }
        footer { text-align: center; padding: 26px; color: var(--muted); font-size: 13px; border-top: 1px solid var(--line); background: #fff; margin-top: 40px; }
        @media (max-width: 820px) {
            .hero { grid-template-columns: 1fr; padding-top: 40px; }
            .grid-3 { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <header>
        <a href="{{ route('home') }}" class="brand">TitipKirim</a>
        <div class="nav-btns">
            @auth
                <a href="{{ route('dashboard') }}" class="btn">Ke Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn light">Masuk</a>
                <a href="{{ route('register') }}" class="btn">Daftar Sekarang</a>
            @endauth
        </div>
    </header>

    <section class="hero">
        <div>
            <h1>Kirim Barang Lebih Cepat Lewat Perjalanan Traveler Terpercaya</h1>
            <p>TitipKirim menghubungkan pengirim barang antarkota dengan traveler yang memiliki ruang bagasi kosong. Hemat biaya, aman, dan terpantau dari penjemputan hingga tiba di tujuan.</p>
            <div class="nav-btns">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn">Buka Dashboard Saya</a>
                @else
                    <a href="{{ route('register') }}" class="btn">Mulai Kirim / Jadi Traveler</a>
                    <a href="{{ route('login') }}" class="btn light">Sudah Punya Akun</a>
                @endauth
            </div>
        </div>
        <div class="hero-card">
            <h3 style="margin-top: 0; color: var(--green);">Kenapa Memilih TitipKirim?</h3>
            <ul style="line-height: 1.9; color: var(--ink); padding-left: 20px; margin-bottom: 0;">
                <li><strong>Rute Fleksibel:</strong> Jadwal keberangkatan setiap hari antarkota.</li>
                <li><strong>Tarif Transparan:</strong> Biaya dihitung jelas per kilogram barang.</li>
                <li><strong>Pelacakan Real-Time:</strong> Status barang terpantau dari dijemput sampai selesai.</li>
                <li><strong>Penghasilan Tambahan:</strong> Traveler bisa memanfaatkan sisa kapasitas bagasi.</li>
            </ul>
        </div>
    </section>

    <section class="section">
        <h2>Cara Kerja TitipKirim</h2>
        <p class="sub">Tiga langkah mudah untuk mengirim maupun membawa titipan barang</p>
        <div class="grid-3">
            <div class="card">
                <div class="step-num">1</div>
                <h3 style="margin: 0 0 8px;">Cari Rute Perjalanan</h3>
                <p style="margin: 0; color: var(--muted); line-height: 1.6;">Pengirim mencari jadwal traveler berdasarkan kota asal, kota tujuan, dan tanggal keberangkatan.</p>
            </div>
            <div class="card">
                <div class="step-num">2</div>
                <h3 style="margin: 0 0 8px;">Ajukan & Bayar Titipan</h3>
                <p style="margin: 0; color: var(--muted); line-height: 1.6;">Isi detail barang, berat, serta data penerima. Setelah disetujui traveler, lakukan pembayaran.</p>
            </div>
            <div class="card">
                <div class="step-num">3</div>
                <h3 style="margin: 0 0 8px;">Pantau Hingga Selesai</h3>
                <p style="margin: 0; color: var(--muted); line-height: 1.6;">Traveler memperbarui status pengiriman mulai dari dijemput, dalam perjalanan, hingga diterima.</p>
            </div>
        </div>
    </section>

    <footer>
        &copy; {{ date('Y') }} TitipKirim — Platform Titip Barang Lewat Perjalanan
    </footer>
</body>
</html>