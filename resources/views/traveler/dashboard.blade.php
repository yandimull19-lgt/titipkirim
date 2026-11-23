@extends('layouts.app')
@section('title', 'Dashboard Traveler')
@section('heading', 'Dashboard Traveler')

@section('content')
<div class="stats">
    <div class="card stat">
        <small>Total Perjalanan Saya</small>
        <strong>{{ $jumlahPerjalanan }}</strong>
    </div>
    <div class="card stat">
        <small>Perjalanan Aktif</small>
        <strong>{{ $perjalananAktif }}</strong>
    </div>
    <div class="card stat">
        <small>Titipan Masuk</small>
        <strong>{{ $titipanMasuk }}</strong>
    </div>
    <div class="card stat">
        <small>Menunggu Konfirmasi</small>
        <strong>{{ $titipanMenunggu }}</strong>
    </div>
</div>

<div class="card">
    <div class="top" style="margin-bottom: 12px;">
        <h3 style="margin: 0;">Permintaan Titipan Terbaru</h3>
        <div class="actions">
            <a class="btn sm" href="{{ route('perjalanan.create') }}">+ Tambah Perjalanan</a>
            <a class="btn light sm" href="{{ route('titipan.incoming') }}">Lihat Semua Titipan Masuk</a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Pengirim</th>
                <th>Barang</th>
                <th>Rute</th>
                <th>Biaya</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($permintaanTerbaru as $t)
                <tr>
                    <td>{{ $t->pengirim->name }}</td>
                    <td><strong>{{ $t->nama_barang }}</strong> ({{ $t->berat_kg }} kg)</td>
                    <td>{{ $t->perjalanan->kota_asal }} &rarr; {{ $t->perjalanan->kota_tujuan }}</td>
                    <td>Rp {{ number_format($t->biaya_titip, 0, ',', '.') }}</td>
                    <td><span class="badge">{{ ucfirst(str_replace('_', ' ', $t->status)) }}</span></td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada permintaan titipan masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection