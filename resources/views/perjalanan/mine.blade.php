@extends('layouts.app')

@section('title', 'Perjalanan Saya')
@section('heading', 'Perjalanan Saya')

@section('content')
    <div class="card">
        <p><a class="btn" href="{{ route('perjalanan.create') }}">Tambah perjalanan</a></p>
        <table>
            <thead>
                <tr>
                    <th>Rute</th>
                    <th>Tanggal</th>
                    <th>Kapasitas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($perjalanans as $p)
                    <tr>
                        <td>{{ $p->kota_asal }} → {{ $p->kota_tujuan }}</td>
                        <td>{{ $p->tanggal_berangkat->format('d-m-Y') }}</td>
                        <td>{{ $p->kapasitas_kg }} kg</td>
                        <td>{{ ucfirst($p->status) }}</td>
                        <td class="actions">
                            <a class="btn light" href="{{ route('perjalanan.edit', $p) }}">Edit</a>
                            <form method="POST" action="{{ route('perjalanan.destroy', $p) }}" onsubmit="return confirm('Hapus perjalanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Anda belum menambahkan perjalanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top: 14px;">{{ $perjalanans->links() }}</div>
    </div>
@endsection