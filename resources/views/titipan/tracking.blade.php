@extends('layouts.app')
@section('title', 'Status & Pelacakan Barang')
@section('heading', 'Status dan Pelacakan Barang')

@section('content')
@php
    $tahapan = ['menunggu' => 1, 'diterima' => 2, 'dijemput' => 3, 'dalam_perjalanan' => 4, 'selesai' => 5];
@endphp

@forelse($titipans as $t)
    @php $step = $tahapan[$t->status] ?? 0; @endphp
    <div class="card">
        <div class="top" style="margin-bottom: 10px;">
            <div>
                <h3 style="margin: 0 0 4px;">{{ $t->nama_barang }} ({{ $t->berat_kg }} kg)</h3>
                <small style="color: #78847c;">
                    Rute: <strong>{{ $t->perjalanan->kota_asal }} &rarr; {{ $t->perjalanan->kota_tujuan }}</strong> •
                    Traveler: {{ $t->perjalanan->traveler->name }} •
                    Penerima: {{ $t->nama_penerima }} ({{ $t->no_hp_penerima }})
                </small>
            </div>
            <span class="badge {{ $t->status === 'ditolak' ? 'danger' : '' }}">
                {{ ucfirst(str_replace('_', ' ', $t->status)) }}
            </span>
        </div>

        @if($t->status === 'ditolak')
            <p class="error" style="margin: 8px 0 0;">Permintaan titipan ditolak oleh traveler.</p>
        @else
            <div class="grid-3" style="grid-template-columns: repeat(5, 1fr); gap: 8px; margin-top: 14px;">
                @foreach(['Menunggu', 'Diterima', 'Dijemput', 'Dalam Perjalanan', 'Selesai'] as $idx => $label)
                    <div style="padding: 10px; border-radius: 10px; text-align: center; font-size: 13px; font-weight: 700;
                        background: {{ $step >= ($idx + 1) ? '#285943' : '#f1f3ee' }};
                        color: {{ $step >= ($idx + 1) ? '#fff' : '#78847c' }};">
                        {{ $idx + 1 }}. {{ $label }}
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@empty
    <div class="card">
        <p style="margin: 0;">Belum ada barang yang sedang dilacak. <a href="{{ route('perjalanan.index') }}">Cari perjalanan sekarang</a>.</p>
    </div>
@endforelse
@endsection