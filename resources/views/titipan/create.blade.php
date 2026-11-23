@extends('layouts.app')
@section('title', 'Form Titip Barang')
@section('heading', 'Form Titip Barang')

@section('content')
<div class="card">
    <p style="margin: 0;">
        <strong>Rute:</strong> {{ $perjalanan->kota_asal }} &rarr; {{ $perjalanan->kota_tujuan }}
        ({{ $perjalanan->tanggal_berangkat->format('d-m-Y') }}) •
        <strong>Traveler:</strong> {{ $perjalanan->traveler->name }} •
        <strong>Maks. Kapasitas:</strong> {{ $perjalanan->kapasitas_kg }} kg •
        <strong>Tarif:</strong> Rp {{ number_format($perjalanan->tarif_per_kg, 0, ',', '.') }}/kg
    </p>
</div>

<div class="card">
    <form method="POST" action="{{ route('titipan.store', $perjalanan) }}">
        @csrf
        <div class="grid-2">
            <div>
                <label>Nama barang</label>
                <input name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Contoh: Dokumen / Paket Makanan" required>
            </div>
            <div>
                <label>Berat barang (kg)</label>
                <input id="berat" type="number" step="0.1" name="berat_kg" value="{{ old('berat_kg') }}" required>
            </div>
        </div>

        <label>Deskripsi barang</label>
        <textarea name="deskripsi_barang" rows="2" placeholder="Keterangan isi paket atau catatan penanganan">{{ old('deskripsi_barang') }}</textarea>

        <div class="grid-2">
            <div>
                <label>Nama penerima</label>
                <input name="nama_penerima" value="{{ old('nama_penerima') }}" required>
            </div>
            <div>
                <label>Nomor HP penerima</label>
                <input name="no_hp_penerima" value="{{ old('no_hp_penerima') }}" required>
            </div>
        </div>

        <label>Alamat lengkap penerima</label>
        <textarea name="alamat_penerima" rows="2" required>{{ old('alamat_penerima') }}</textarea>

        <label>Total biaya titip (Rp)</label>
        <input id="biaya" type="number" name="biaya_titip" value="{{ old('biaya_titip') }}" required>

        <div class="actions">
            <button type="submit" class="btn">Kirim Permintaan Titip</button>
            <a href="{{ route('perjalanan.index') }}" class="btn light">Batal</a>
        </div>
    </form>
</div>

<script>
    const berat = document.getElementById('berat');
    const biaya = document.getElementById('biaya');
    const tarif = {{ (float) $perjalanan->tarif_per_kg }};
    berat.addEventListener('input', () => {
        biaya.value = Math.round((parseFloat(berat.value) || 0) * tarif);
    });
</script>
@endsection