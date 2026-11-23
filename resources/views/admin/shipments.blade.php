@extends('layouts.app')
@section('title', 'Manajemen Titipan')
@section('heading', 'Manajemen Titipan')

@section('content')
<div class="card">
    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Pengirim</th>
                <th>Traveler</th>
                <th>Rute</th>
                <th>Penerima</th>
                <th>Status Barang</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($titipans as $t)
                <tr>
                    <td><strong>{{ $t->nama_barang }}</strong> ({{ $t->berat_kg }} kg)</td>
                    <td>{{ $t->pengirim->name }}</td>
                    <td>{{ $t->perjalanan->traveler->name }}</td>
                    <td>{{ $t->perjalanan->kota_asal }} &rarr; {{ $t->perjalanan->kota_tujuan }}</td>
                    <td>{{ $t->nama_penerima }}</td>
                    <td><span class="badge">{{ ucfirst(str_replace('_', ' ', $t->status)) }}</span></td>
                    <td><span class="badge {{ $t->status_pembayaran === 'dibayar' ? '' : 'warn' }}">{{ ucfirst(str_replace('_', ' ', $t->status_pembayaran)) }}</span></td>
                </tr>
            @empty
                <tr><td colspan="7">Belum ada data titipan.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top: 14px;">{{ $titipans->links() }}</div>
</div>
@endsection