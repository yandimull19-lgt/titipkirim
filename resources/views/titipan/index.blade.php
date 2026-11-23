@extends('layouts.app')
@section('title', 'Riwayat Titipan')
@section('heading', 'Riwayat Titipan')

@section('content')
<div class="card">
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Rute & Traveler</th>
                <th>Penerima</th>
                <th>Biaya</th>
                <th>Status</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($titipans as $t)
                <tr>
                    <td>{{ $t->created_at->format('d-m-Y') }}</td>
                    <td><strong>{{ $t->nama_barang }}</strong> ({{ $t->berat_kg }} kg)</td>
                    <td>{{ $t->perjalanan->kota_asal }} &rarr; {{ $t->perjalanan->kota_tujuan }}<br><small>{{ $t->perjalanan->traveler->name }}</small></td>
                    <td>{{ $t->nama_penerima }}<br><small>{{ $t->alamat_penerima }}</small></td>
                    <td>Rp {{ number_format($t->biaya_titip, 0, ',', '.') }}</td>
                    <td><span class="badge">{{ ucfirst(str_replace('_', ' ', $t->status)) }}</span></td>
                    <td><span class="badge {{ $t->status_pembayaran === 'dibayar' ? '' : 'warn' }}">{{ ucfirst(str_replace('_', ' ', $t->status_pembayaran)) }}</span></td>
                </tr>
            @empty
                <tr><td colspan="7">Belum ada riwayat titipan barang.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top: 14px;">{{ $titipans->links() }}</div>
</div>
@endsection