@extends('layouts.app')
@section('title', 'Dashboard Pengirim')
@section('heading', 'Dashboard Pengirim')

@section('content')
<div class="stats">
    <div class="card stat">
        <small>Total Titipan Saya</small>
        <strong>{{ $totalTitipan }}</strong>
    </div>
    <div class="card stat">
        <small>Barang Dalam Proses</small>
        <strong>{{ $titipanAktif }}</strong>
    </div>
    <div class="card stat">
        <small>Titipan Selesai</small>
        <strong>{{ $titipanSelesai }}</strong>
    </div>
</div>

<div class="card">
    <div class="top" style="margin-bottom: 12px;">
        <h3 style="margin: 0;">Perjalanan Tersedia Terbaru</h3>
        <a class="btn sm" href="{{ route('perjalanan.index') }}">Cari Semua Perjalanan</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Rute</th>
                <th>Tanggal</th>
                <th>Traveler</th>
                <th>Sisa Kapasitas</th>
                <th>Tarif/kg</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($perjalananTersedia as $item)
                <tr>
                    <td><strong>{{ $item->kota_asal }} &rarr; {{ $item->kota_tujuan }}</strong></td>
                    <td>{{ $item->tanggal_berangkat->format('d-m-Y') }}</td>
                    <td>{{ $item->traveler->name }}</td>
                    <td>{{ $item->kapasitas_kg }} kg</td>
                    <td>Rp {{ number_format($item->tarif_per_kg, 0, ',', '.') }}</td>
                    <td><a class="btn sm" href="{{ route('titipan.create', $item) }}">Titip Barang</a></td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada jadwal perjalanan tersedia.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="card">
    <div class="top" style="margin-bottom: 12px;">
        <h3 style="margin: 0;">Status Titipan Terakhir</h3>
        <a class="btn light sm" href="{{ route('titipan.tracking') }}">Lacak Semua Barang</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Rute</th>
                <th>Penerima</th>
                <th>Status</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($titipanTerbaru as $t)
                <tr>
                    <td><strong>{{ $t->nama_barang }}</strong> ({{ $t->berat_kg }} kg)</td>
                    <td>{{ $t->perjalanan->kota_asal }} &rarr; {{ $t->perjalanan->kota_tujuan }}</td>
                    <td>{{ $t->nama_penerima }}</td>
                    <td><span class="badge">{{ ucfirst(str_replace('_', ' ', $t->status)) }}</span></td>
                    <td><span class="badge {{ $t->status_pembayaran === 'dibayar' ? '' : 'warn' }}">{{ ucfirst(str_replace('_', ' ', $t->status_pembayaran)) }}</span></td>
                </tr>
            @empty
                <tr><td colspan="5">Anda belum pernah membuat titipan barang.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection