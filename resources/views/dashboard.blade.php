@extends('layouts.app')

@section('title', 'Dashboard')
@section('heading', 'Selamat datang, ' . auth()->user()->name)

@section('content')
    <div class="stats">
        <div class="card stat">
            <small>Perjalanan Saya</small>
            <strong>{{ $jumlahPerjalanan }}</strong>
        </div>
        <div class="card stat">
            <small>Titipan Saya</small>
            <strong>{{ $jumlahTitipan }}</strong>
        </div>
        <div class="card stat">
            <small>Titipan Masuk</small>
            <strong>{{ $titipanMasuk }}</strong>
        </div>
    </div>

    @if($statistikAdmin)
        <div class="card">
            <h3>Ringkasan Admin</h3>
            <p>
                Pengguna: <strong>{{ $statistikAdmin['pengguna'] }}</strong> |
                Perjalanan: <strong>{{ $statistikAdmin['perjalanan'] }}</strong> |
                Titipan: <strong>{{ $statistikAdmin['titipan'] }}</strong>
            </p>
        </div>
    @endif

    <div class="card">
        <div class="top">
            <h3>Perjalanan tersedia</h3>
            <a class="btn" href="{{ route('perjalanan.index') }}">Lihat semua</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Rute</th>
                    <th>Tanggal</th>
                    <th>Traveler</th>
                    <th>Tarif/kg</th>
                </tr>
            </thead>
            <tbody>
                @forelse($perjalananTerbaru as $p)
                    <tr>
                        <td>{{ $p->kota_asal }} → {{ $p->kota_tujuan }}</td>
                        <td>{{ $p->tanggal_berangkat->format('d-m-Y') }}</td>
                        <td>{{ $p->traveler->name }}</td>
                        <td>Rp {{ number_format($p->tarif_per_kg, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada perjalanan tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection