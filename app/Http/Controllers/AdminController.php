<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Perjalanan;
use App\Models\Titipan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function pastikanAdmin(): void
    {
        abort_unless(auth()->user()->role === 'admin', 403);
    }

    public function users()
    {
        $this->pastikanAdmin();
        $pengguna = User::latest()->paginate(15);

        return view('admin.users', compact('pengguna'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $this->pastikanAdmin();

        $data = $request->validate([
            'role' => 'required|in:pengirim,traveler,admin',
        ]);

        $user->update(['role' => $data['role']]);

        return back()->with('success', 'Peran pengguna berhasil diperbarui.');
    }

    public function trips()
    {
        $this->pastikanAdmin();
        $perjalanans = Perjalanan::with('traveler')->latest()->paginate(15);

        return view('admin.trips', compact('perjalanans'));
    }

    public function shipments()
    {
        $this->pastikanAdmin();
        $titipans = Titipan::with(['pengirim', 'perjalanan.traveler'])->latest()->paginate(15);

        return view('admin.shipments', compact('titipans'));
    }

    public function transactions()
    {
        $this->pastikanAdmin();
        $transaksis = Titipan::with(['pengirim', 'perjalanan.traveler'])
            ->whereIn('status', ['diterima', 'dijemput', 'dalam_perjalanan', 'selesai'])
            ->latest()
            ->paginate(15);

        $totalLunas = Titipan::where('status_pembayaran', 'dibayar')->sum('biaya_titip');
        $totalTertunda = Titipan::where('status_pembayaran', 'belum_bayar')
            ->whereIn('status', ['diterima', 'dijemput', 'dalam_perjalanan', 'selesai'])
            ->sum('biaya_titip');

        return view('admin.transactions', compact('transaksis', 'totalLunas', 'totalTertunda'));
    }
}