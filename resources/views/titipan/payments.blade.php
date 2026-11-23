@extends('layouts.app')
@section('title', 'Pembayaran Titipan')
@section('heading', 'Pembayaran Titipan')

@section('content')
<div class="stats">
    <div class="card stat">
        <small>Tagihan Menunggu Pembayaran</small>
        <strong>Rp {{ number_format($totalBelumBayar, 0, ',', '.') }}</strong>
    </div>
    <div class="card stat">
        <small>Total Sudah Dibayar</small>
        <strong>Rp {{ number_format($totalSudahBayar, 0, ',', '.') }}</strong>
    </div>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Rute</th>
                <th>Biaya Titip</th>
                <th>Status Titipan</th>
                <th>Status Bayar</th>
                <th>Aksi Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($titipans as $t)
                <tr>
                    <td><strong>{{ $t->nama_barang }}</strong></td>
                    <td>{{ $t->perjalanan->kota_asal }} &rarr; {{ $t->perjalanan->kota_tujuan }}</td>
                    <td><strong>Rp {{ number_format($t->biaya_titip, 0, ',', '.') }}</strong></td>
                    <td>{{ ucfirst(str_replace('_', ' ', $t->status)) }}</td>
                    <td>
                        <span class="badge {{ $t->status_pembayaran === 'dibayar' ? '' : 'warn' }}">
                            {{ ucfirst(str_replace('_', ' ', $t->status_pembayaran)) }}
                        </span>
                        @if($t->metode_pembayaran)
                            <div style="font-size: 12px; color: #78847c; margin-top: 3px;">via {{ $t->metode_pembayaran }}</div>
                        @endif
                    </td>
                    <td>
                        @if($t->status === 'diterima' && $t->status_pembayaran === 'belum_bayar')
                            <form method="POST" action="{{ route('titipan.pay', $t) }}" class="actions">
                                @csrf @method('PATCH')
                                <select name="metode_pembayaran" style="width: auto; margin: 0; padding: 7px 10px;" required>
                                    <option value="Transfer Bank">Transfer Bank</option>
                                    <option value="E-Wallet (DANA/OVO/GoPay)">E-Wallet</option>
                                    <option value="Tunai (COD)">Tunai</option>
                                </select>
                                <button class="btn sm" type="submit">Bayar Sekarang</button>
                            </form>
                        @elseif($t->status_pembayaran === 'dibayar')
                            <span style="color: #285943; font-size: 13px;">Lunas ({{ $t->tanggal_bayar?->format('d-m-Y') }})</span>
                        @else
                            <span style="color: #78847c; font-size: 13px;">Menunggu persetujuan traveler</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada data transaksi pembayaran.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top: 14px;">{{ $titipans->links() }}</div>
</div>
@endsection