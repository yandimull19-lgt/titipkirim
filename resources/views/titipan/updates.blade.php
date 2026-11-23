@extends('layouts.app')
@section('title', 'Update Status Pengiriman')
@section('heading', 'Update Status Pengiriman')

@section('content')
<div class="card">
    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Rute</th>
                <th>Penerima</th>
                <th>Pembayaran</th>
                <th>Status Saat Ini</th>
                <th>Perbarui Tahap Pengiriman</th>
            </tr>
        </thead>
        <tbody>
            @forelse($titipans as $t)
                <tr>
                    <td><strong>{{ $t->nama_barang }}</strong> ({{ $t->berat_kg }} kg)</td>
                    <td>{{ $t->perjalanan->kota_asal }} &rarr; {{ $t->perjalanan->kota_tujuan }}</td>
                    <td>{{ $t->nama_penerima }}<br><small>{{ $t->no_hp_penerima }}</small></td>
                    <td><span class="badge {{ $t->status_pembayaran === 'dibayar' ? '' : 'warn' }}">{{ ucfirst(str_replace('_', ' ', $t->status_pembayaran)) }}</span></td>
                    <td><span class="badge">{{ ucfirst(str_replace('_', ' ', $t->status)) }}</span></td>
                    <td>
                        @if($t->status === 'diterima')
                            <form method="POST" action="{{ route('titipan.status', $t) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="dijemput">
                                <button class="btn sm" type="submit">Tandai Dijemput</button>
                            </form>
                        @elseif($t->status === 'dijemput')
                            <form method="POST" action="{{ route('titipan.status', $t) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="dalam_perjalanan">
                                <button class="btn sm" type="submit">Tandai Dalam Perjalanan</button>
                            </form>
                        @elseif($t->status === 'dalam_perjalanan')
                            <form method="POST" action="{{ route('titipan.status', $t) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="selesai">
                                <button class="btn sm" type="submit">Tandai Selesai Diterima</button>
                            </form>
                        @else
                            <span style="color: #285943; font-weight: 700;">Pengiriman Selesai</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada barang yang sedang dalam proses pengiriman.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top: 14px;">{{ $titipans->links() }}</div>
</div>
@endsection