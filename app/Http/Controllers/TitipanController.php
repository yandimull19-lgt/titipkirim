<?php

namespace App\Http\Controllers;

use App\Models\Titipan;
use App\Models\Perjalanan;
use Illuminate\Http\Request;

class TitipanController extends Controller
{
    public function index()
    {
        $titipans = Titipan::with(['perjalanan.traveler', 'pengirim'])
            ->where('pengirim_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('titipan.index', compact('titipans'));
    }

    public function tracking()
    {
        $titipans = Titipan::with(['perjalanan.traveler'])
            ->where('pengirim_id', auth()->id())
            ->latest()
            ->get();

        return view('titipan.tracking', compact('titipans'));
    }

    public function payments()
    {
        $titipans = Titipan::with(['perjalanan.traveler'])
            ->where('pengirim_id', auth()->id())
            ->latest()
            ->paginate(10);

        $totalBelumBayar = Titipan::where('pengirim_id', auth()->id())
            ->where('status', 'diterima')
            ->where('status_pembayaran', 'belum_bayar')
            ->sum('biaya_titip');

        $totalSudahBayar = Titipan::where('pengirim_id', auth()->id())
            ->where('status_pembayaran', 'dibayar')
            ->sum('biaya_titip');

        return view('titipan.payments', compact('titipans', 'totalBelumBayar', 'totalSudahBayar'));
    }

    public function create(Perjalanan $perjalanan)
    {
        abort_unless($perjalanan->status === 'tersedia', 404);
        abort_unless($perjalanan->user_id !== auth()->id(), 403);

        return view('titipan.create', compact('perjalanan'));
    }

    public function store(Request $request, Perjalanan $perjalanan)
    {
        abort_unless($perjalanan->status === 'tersedia', 404);
        abort_unless($perjalanan->user_id !== auth()->id(), 403);

        $data = $request->validate([
            'nama_barang' => 'required|string|max:150',
            'deskripsi_barang' => 'nullable|string|max:1000',
            'berat_kg' => 'required|numeric|min:0.1',
            'nama_penerima' => 'required|string|max:100',
            'no_hp_penerima' => 'required|string|max:25',
            'alamat_penerima' => 'required|string|max:1000',
            'biaya_titip' => 'required|numeric|min:0',
        ]);

        if ($data['berat_kg'] > $perjalanan->kapasitas_kg) {
            return back()->withErrors(['berat_kg' => 'Berat melebihi kapasitas perjalanan.'])->withInput();
        }

        $data['perjalanan_id'] = $perjalanan->id;
        $data['pengirim_id'] = auth()->id();

        Titipan::create($data);

        return redirect()->route('titipan.tracking')
            ->with('success', 'Permintaan titipan berhasil dikirim! Pantau statusnya di sini.');
    }

    public function incoming()
    {
        $titipans = Titipan::with(['perjalanan', 'pengirim'])
            ->whereHas('perjalanan', fn ($q) => $q->where('user_id', auth()->id()))
            ->latest()
            ->paginate(10);

        return view('titipan.incoming', compact('titipans'));
    }

    public function deliveryUpdates()
    {
        $titipans = Titipan::with(['perjalanan', 'pengirim'])
            ->whereHas('perjalanan', fn ($q) => $q->where('user_id', auth()->id()))
            ->whereIn('status', ['diterima', 'dijemput', 'dalam_perjalanan', 'selesai'])
            ->latest()
            ->paginate(10);

        return view('titipan.updates', compact('titipans'));
    }

    public function updateStatus(Request $request, Titipan $titipan)
    {
        $isTraveler = $titipan->perjalanan->user_id === auth()->id();
        abort_unless($isTraveler, 403);

        $data = $request->validate([
            'status' => 'required|in:diterima,ditolak,dijemput,dalam_perjalanan,selesai',
        ]);

        $allowed = [
            'menunggu' => ['diterima', 'ditolak'],
            'diterima' => ['dijemput'],
            'dijemput' => ['dalam_perjalanan'],
            'dalam_perjalanan' => ['selesai'],
        ];

        abort_unless(in_array($data['status'], $allowed[$titipan->status] ?? []), 422);

        $titipan->update(['status' => $data['status']]);

        return back()->with('success', 'Status pengiriman berhasil diperbarui.');
    }

    public function pay(Request $request, Titipan $titipan)
    {
        abort_unless($titipan->pengirim_id === auth()->id(), 403);
        abort_unless($titipan->status === 'diterima', 422);

        $data = $request->validate([
            'metode_pembayaran' => 'required|string|max:50',
        ]);

        $titipan->update([
            'status_pembayaran' => 'dibayar',
            'metode_pembayaran' => $data['metode_pembayaran'],
            'tanggal_bayar' => now(),
        ]);

        return back()->with('success', 'Pembayaran berhasil dicatat.');
    }
}