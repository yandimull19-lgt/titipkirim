@extends('layouts.app')

@section('title', 'Tambah Perjalanan')
@section('heading', 'Tambah Perjalanan')

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('perjalanan.store') }}">
            @csrf
            <label>Kota asal</label>
            <input name="kota_asal" value="{{ old('kota_asal') }}" required>

            <label>Kota tujuan</label>
            <input name="kota_tujuan" value="{{ old('kota_tujuan') }}" required>

            <label>Tanggal berangkat</label>
            <input type="date" name="tanggal_berangkat" min="{{ date('Y-m-d') }}" value="{{ old('tanggal_berangkat') }}" required>

            <label>Jam berangkat</label>
            <input type="time" name="jam_berangkat" value="{{ old('jam_berangkat') }}">

            <label>Jenis transportasi</label>
            <select name="jenis_transportasi" required>
                <option value="">Pilih</option>
                <option value="Mobil" {{ old('jenis_transportasi') == 'Mobil' ? 'selected' : '' }}>Mobil</option>
                <option value="Motor" {{ old('jenis_transportasi') == 'Motor' ? 'selected' : '' }}>Motor</option>
                <option value="Travel" {{ old('jenis_transportasi') == 'Travel' ? 'selected' : '' }}>Travel</option>
                <option value="Bus" {{ old('jenis_transportasi') == 'Bus' ? 'selected' : '' }}>Bus</option>
                <option value="Pesawat" {{ old('jenis_transportasi') == 'Pesawat' ? 'selected' : '' }}>Pesawat</option>
                <option value="Kereta Api" {{ old('jenis_transportasi') == 'Kereta Api' ? 'selected' : '' }}>Kereta Api</option>
            </select>

            <label>Kapasitas tersedia (kg)</label>
            <input type="number" step="0.1" min="0.1" name="kapasitas_kg" value="{{ old('kapasitas_kg') }}" required>

            <label>Tarif per kg (Rp)</label>
            <input type="number" min="0" name="tarif_per_kg" value="{{ old('tarif_per_kg') }}" required>

            <label>Catatan</label>
            <textarea name="catatan">{{ old('catatan') }}</textarea>

            <button class="btn" type="submit">Simpan Perjalanan</button>
        </form>
    </div>
@endsection