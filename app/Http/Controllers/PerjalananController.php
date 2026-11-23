<?php

namespace App\Http\Controllers;

use App\Models\Perjalanan;
use Illuminate\Http\Request;

class PerjalananController extends Controller
{
    public function index(Request $request)
    {
        $query = Perjalanan::with('traveler')
            ->where('status', 'tersedia')
            ->whereDate('tanggal_berangkat', '>=', now()->toDateString());

        if ($request->filled('kota_asal')) {
            $query->where('kota_asal', 'like', '%' . $request->kota_asal . '%');
        }

        if ($request->filled('kota_tujuan')) {
            $query->where('kota_tujuan', 'like', '%' . $request->kota_tujuan . '%');
        }

        if ($request->filled('tanggal_berangkat')) {
            $query->whereDate('tanggal_berangkat', $request->tanggal_berangkat);
        }

        $perjalanans = $query->orderBy('tanggal_berangkat')->paginate(10)->withQueryString();

        return view('perjalanan.index', compact('perjalanans'));
    }

    public function mine()
    {
        $perjalanans = Perjalanan::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('perjalanan.mine', compact('perjalanans'));
    }

    public function create()
    {
        return view('perjalanan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kota_asal' => 'required|string|max:100',
            'kota_tujuan' => 'required|string|max:100',
            'tanggal_berangkat' => 'required|date|after_or_equal:today',
            'jam_berangkat' => 'nullable',
            'jenis_transportasi' => 'required|string|max:50',
            'kapasitas_kg' => 'required|numeric|min:0.1',
            'tarif_per_kg' => 'required|numeric|min:0',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $data['user_id'] = auth()->id();

        Perjalanan::create($data);

        return redirect()->route('perjalanan.mine')
            ->with('success', 'Perjalanan berhasil ditambahkan.');
    }

    public function edit(Perjalanan $perjalanan)
    {
        abort_unless($perjalanan->user_id === auth()->id(), 403);

        return view('perjalanan.edit', compact('perjalanan'));
    }

    public function update(Request $request, Perjalanan $perjalanan)
    {
        abort_unless($perjalanan->user_id === auth()->id(), 403);

        $data = $request->validate([
            'kota_asal' => 'required|string|max:100',
            'kota_tujuan' => 'required|string|max:100',
            'tanggal_berangkat' => 'required|date',
            'jam_berangkat' => 'nullable',
            'jenis_transportasi' => 'required|string|max:50',
            'kapasitas_kg' => 'required|numeric|min:0.1',
            'tarif_per_kg' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,ditutup',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $perjalanan->update($data);

        return redirect()->route('perjalanan.mine')
            ->with('success', 'Perjalanan berhasil diperbarui.');
    }

    public function destroy(Perjalanan $perjalanan)
    {
        abort_unless($perjalanan->user_id === auth()->id(), 403);
        $perjalanan->delete();

        return redirect()->route('perjalanan.mine')
            ->with('success', 'Perjalanan berhasil dihapus.');
    }
}