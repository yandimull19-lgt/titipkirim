@extends('layouts.app')

@section('title', 'Admin')
@section('heading', 'Panel Admin')

@section('content')
    <div class="card">
        <h3>Data Pengguna</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Peran</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengguna as $u)
                    <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->no_hp ?? '-' }}</td>
                        <td>{{ ucfirst($u->role) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 14px;">{{ $pengguna->links() }}</div>
    </div>

    <div class="card">
        <h3>Perjalanan Terbaru</h3>
        <table>
            <thead>
                <tr>
                    <th>Traveler</th>
                    <th>Rute</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($perjalanans as $p)
                    <tr>
                        <td>{{ $p->traveler->name }}</td>
                        <td>{{ $p->kota_asal }} → {{ $p->kota_tujuan }}</td>
                        <td>{{ $p->tanggal_berangkat->format('d-m-Y') }}</td>
                        <td>{{ ucfirst($p->status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada data perjalanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card">
        <h3>Titipan Terbaru</h3>
        <table>
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Pengirim</th>
                    <th>Biaya</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($titipans as $t)
                    <tr>
                        <td>{{ $t->nama_barang }}</td>
                        <td>{{ $t->pengirim->name }}</td>
                        <td>Rp {{ number_format($t->biaya_titip, 0, ',', '.') }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $t->status)) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada data titipan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection