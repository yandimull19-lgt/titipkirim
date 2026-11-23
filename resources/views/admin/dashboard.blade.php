@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('heading', 'Dashboard Admin')

@section('content')
<div class="stats">
    <div class="card stat">
        <small>Total Pengguna ({{ $totalPengirim }} Pengirim / {{ $totalTraveler }} Traveler)</small>
        <strong>{{ $totalPengguna }}</strong>
    </div>
    <div class="card stat">
        <small>Total Perjalanan</small>
        <strong>{{ $totalPerjalanan }}</strong>
    </div>
    <div class="card stat">
        <small>Total Titipan</small>
        <strong>{{ $totalTitipan }}</strong>
    </div>
    <div class="card stat">
        <small>Transaksi Lunas</small>
        <strong>Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</strong>
    </div>
</div>

<div class="card">
    <div class="top" style="margin-bottom: 12px;">
        <h3 style="margin: 0;">Aktivitas Titipan Terbaru</h3>
        <a class="btn sm" href="{{ route('admin.shipments') }}">Kelola Semua Titipan</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Pengirim</th>
                <th>Traveler</th>
                <th>Rute</th>
                <th>Biaya</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($titipanTerbaru as $t)
                <tr>
                    <td><strong>{{ $t->nama_barang }}</strong></td>
                    <td>{{ $t->pengirim->name }}</td>
                    <td>{{ $t->perjalanan->traveler->name }}</td>
                    <td>{{ $t->perjalanan->kota_asal }} &rarr; {{ $t->perjalanan->kota_tujuan }}</td>
                    <td>Rp {{ number_format($t->biaya_titip, 0, ',', '.') }}</td>
                    <td><span class="badge">{{ ucfirst(str_replace('_', ' ', $t->status)) }}</span></td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada transaksi titipan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection