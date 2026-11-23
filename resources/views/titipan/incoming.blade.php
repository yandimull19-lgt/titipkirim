@extends('layouts.app')

@section('title', 'Titipan Masuk')
@section('heading', 'Titipan Masuk')

@section('content')
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Pengirim</th>
                    <th>Rute</th>
                    <th>Berat</th>
                    <th>Status</th>
                    <th>Proses</th>
                </tr>
            </thead>
            <tbody>
                @forelse($titipans as $t)
                    <tr>
                        <td>{{ $t->nama_barang }}</td>
                        <td>{{ $t->pengirim->name }}</td>
                        <td>{{ $t->perjalanan->kota_asal }} → {{ $t->perjalanan->kota_tujuan }}</td>
                        <td>{{ $t->berat_kg }} kg</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $t->status)) }}</td>
                        <td class="actions">
                            @if($t->status === 'menunggu')
                                @foreach(['diterima' => 'Terima', 'ditolak' => 'Tolak'] as $value => $label)
                                    <form method="POST" action="{{ route('titipan.status', $t) }}" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="{{ $value }}">
                                        <button class="btn {{ $value === 'ditolak' ? 'danger' : '' }}" type="submit">{{ $label }}</button>
                                    </form>
                                @endforeach
                            @elseif($t->status === 'diterima')
                                <form method="POST" action="{{ route('titipan.status', $t) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="dijemput">
                                    <button class="btn" type="submit">Dijemput</button>
                                </form>
                            @elseif($t->status === 'dijemput')
                                <form method="POST" action="{{ route('titipan.status', $t) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="dalam_perjalanan">
                                    <button class="btn" type="submit">Dalam Perjalanan</button>
                                </form>
                            @elseif($t->status === 'dalam_perjalanan')
                                <form method="POST" action="{{ route('titipan.status', $t) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="selesai">
                                    <button class="btn" type="submit">Selesai</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Belum ada permintaan masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top: 14px;">{{ $titipans->links() }}</div>
    </div>
@endsection