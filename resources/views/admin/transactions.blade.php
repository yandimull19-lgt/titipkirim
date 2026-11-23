@extends('layouts.app')
@section('title', 'Laporan Transaksi')
@section('heading', 'Laporan Transaksi')

@section('content')
<div class="stats">
    <div class="card stat">
        <small>Total Pembayaran Lunas</small>
        <strong>Rp {{ number_format($totalLunas, 0, ',', '.') }}</strong>
    </div>
    <div class="card stat">
        <small>Menunggu Pelunasan</small>
        <strong>Rp {{ number_format($totalTertunda, 0, ',', '.') }}</strong>
    </div>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Pengirim</th>
                <th>Traveler</th>
                <th>Nominal</th>
                <th>Metode</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $tr)
                <tr>
                    <td>{{ $tr->created_at->format('d-m-Y') }}</td>
                    <td><strong>{{ $tr->nama_barang }}</strong></td>
                    <td>{{ $tr->pengirim->name }}</td>
                    <td>{{ $tr->perjalanan->traveler->name }}</td>
                    <td><strong>Rp {{ number_format($tr->biaya_titip, 0, ',', '.') }}</strong></td>
                    <td>{{ $tr->metode_pembayaran ?? '-' }}</td>
                    <td><span class="badge {{ $tr->status_pembayaran === 'dibayar' ? '' : 'warn' }}">{{ ucfirst(str_replace('_', ' ', $tr->status_pembayaran)) }}</span></td>
                </tr>
            @empty
                <tr><td colspan="7">Belum ada data transaksi.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top: 14px;">{{ $transaksis->links() }}</div>
</div>
@endsection