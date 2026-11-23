@extends('layouts.app')
@section('title', 'Manajemen Perjalanan')
@section('heading', 'Manajemen Perjalanan')

@section('content')
<div class="card">
    <table>
        <thead>
            <tr>
                <th>Traveler</th>
                <th>Rute Perjalanan</th>
                <th>Tanggal Berangkat</th>
                <th>Transportasi</th>
                <th>Kapasitas</th>
                <th>Tarif/kg</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($perjalanans as $p)
                <tr>
                    <td><strong>{{ $p->traveler->name }}</strong></td>
                    <td>{{ $p->kota_asal }} &rarr; {{ $p->kota_tujuan }}</td>
                    <td>{{ $p->tanggal_berangkat->format('d-m-Y') }}</td>
                    <td>{{ $p->jenis_transportasi }}</td>
                    <td>{{ $p->kapasitas_kg }} kg</td>
                    <td>Rp {{ number_format($p->tarif_per_kg, 0, ',', '.') }}</td>
                    <td><span class="badge {{ $p->status === 'tersedia' ? '' : 'warn' }}">{{ ucfirst($p->status) }}</span></td>
                </tr>
            @empty
                <tr><td colspan="7">Belum ada data perjalanan terdaftar.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top: 14px;">{{ $perjalanans->links() }}</div>
</div>
@endsection