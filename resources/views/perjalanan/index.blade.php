@extends('layouts.app')
@section('title', 'Cari Perjalanan')
@section('heading', 'Cari Perjalanan')

@section('content')
<div class="card">
    <form method="GET" action="{{ route('perjalanan.index') }}">
        <div class="grid-3">
            <div>
                <label>Kota Asal</label>
                <input name="kota_asal" value="{{ request('kota_asal') }}" placeholder="Contoh: Batusangkar">
            </div>
            <div>
                <label>Kota Tujuan</label>
                <input name="kota_tujuan" value="{{ request('kota_tujuan') }}" placeholder="Contoh: Padang">
            </div>
            <div>
                <label>Tanggal Berangkat</label>
                <input type="date" name="tanggal_berangkat" value="{{ request('tanggal_berangkat') }}">
            </div>
        </div>
        <div class="actions">
            <button type="submit" class="btn">Cari Rute</button>
            <a href="{{ route('perjalanan.index') }}" class="btn light">Reset Filter</a>
        </div>
    </form>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Rute Perjalanan</th>
                <th>Tanggal & Jam</th>
                <th>Traveler</th>
                <th>Transportasi</th>
                <th>Kapasitas</th>
                <th>Tarif/kg</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($perjalanans as $item)
                <tr>
                    <td><strong>{{ $item->kota_asal }} &rarr; {{ $item->kota_tujuan }}</strong></td>
                    <td>{{ $item->tanggal_berangkat->format('d-m-Y') }} {{ $item->jam_berangkat }}</td>
                    <td>{{ $item->traveler->name }}</td>
                    <td>{{ $item->jenis_transportasi }}</td>
                    <td>{{ $item->kapasitas_kg }} kg</td>
                    <td>Rp {{ number_format($item->tarif_per_kg, 0, ',', '.') }}</td>
                    <td>
                        @if($item->user_id !== auth()->id())
                            <a class="btn sm" href="{{ route('titipan.create', $item) }}">Titip Barang</a>
                        @else
                            <span class="badge">Perjalanan Anda</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">Tidak ditemukan perjalanan yang sesuai.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top: 14px;">{{ $perjalanans->links() }}</div>
</div>
@endsection