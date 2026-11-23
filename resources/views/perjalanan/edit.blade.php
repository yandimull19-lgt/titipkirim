@extends('layouts.app')

@section('title', 'Edit Perjalanan')
@section('heading', 'Edit Perjalanan')

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('perjalanan.update', $perjalanan) }}">
            @csrf
            @method('PUT')

            <label>Kota asal</label>
            <input name="kota_asal" value="{{ old('kota_asal', $perjalanan->kota_asal) }}" required>

            <label>Kota tujuan</label>
            <input name="kota_tujuan" value="{{ old('kota_tujuan', $perjalanan->kota_tujuan) }}" required>

            <label>Tanggal berangkat</label>
            <input type="date" name="tanggal_berangkat" value="{{ old('tanggal_berangkat', $perjalanan->tanggal_berangkat->format('Y-m-d')) }}" required>

            <label>Jam berangkat</label>
            <input type="time" name="jam_berangkat" value="{{ old('jam_berangkat', $perjalanan->jam_berangkat) }}">

            <label>Jenis transportasi</label>
            <input name="jenis_transportasi" value="{{ old('jenis_transportasi', $perjalanan->jenis_transportasi) }}" required>

            <label>Kapasitas (kg)</label>
            <input type="number" step="0.1" name="kapasitas_kg" value="{{ old('kapasitas_kg', $perjalanan->kapasitas_kg) }}" required>

            <label>Tarif per kg</label>
            <input type="number" name="tarif_per_kg" value="{{ old('tarif_per_kg', $perjalanan->tarif_per_kg) }}" required>

            <label>Status</label>
            <select name="status">
                <option value="tersedia" {{ $perjalanan->status === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="ditutup" {{ $perjalanan->status === 'ditutup' ? 'selected' : '' }}>Ditutup</option>
            </select>

            <label>Catatan</label>
            <textarea name="catatan">{{ old('catatan', $perjalanan->catatan) }}</textarea>

            <button class="btn" type="submit">Simpan Perubahan</button>
        </form>
    </div>
@endsection