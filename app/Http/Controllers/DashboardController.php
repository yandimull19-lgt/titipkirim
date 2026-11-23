<?php

namespace App\Http\Controllers;

use App\Models\Perjalanan;
use App\Models\Titipan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $totalPengguna = User::count();
            $totalPengirim = User::where('role', 'pengirim')->count();
            $totalTraveler = User::where('role', 'traveler')->count();
            $totalPerjalanan = Perjalanan::count();
            $totalTitipan = Titipan::count();
            $totalTransaksi = Titipan::where('status_pembayaran', 'dibayar')->sum('biaya_titip');
            $titipanTerbaru = Titipan::with(['pengirim', 'perjalanan.traveler'])->latest()->take(5)->get();

            return view('admin.dashboard', compact(
                'totalPengguna',
                'totalPengirim',
                'totalTraveler',
                'totalPerjalanan',
                'totalTitipan',
                'totalTransaksi',
                'titipanTerbaru'
            ));
        }

        if ($user->role === 'traveler') {
            $jumlahPerjalanan = Perjalanan::where('user_id', $user->id)->count();
            $perjalananAktif = Perjalanan::where('user_id', $user->id)->where('status', 'tersedia')->count();
            $titipanMasuk = Titipan::whereHas('perjalanan', fn ($q) => $q->where('user_id', $user->id))->count();
            $titipanMenunggu = Titipan::whereHas('perjalanan', fn ($q) => $q->where('user_id', $user->id))
                ->where('status', 'menunggu')
                ->count();

            $permintaanTerbaru = Titipan::with(['pengirim', 'perjalanan'])
                ->whereHas('perjalanan', fn ($q) => $q->where('user_id', $user->id))
                ->latest()
                ->take(5)
                ->get();

            return view('traveler.dashboard', compact(
                'jumlahPerjalanan',
                'perjalananAktif',
                'titipanMasuk',
                'titipanMenunggu',
                'permintaanTerbaru'
            ));
        }

        // Default: Role Pengirim
        $totalTitipan = Titipan::where('pengirim_id', $user->id)->count();
        $titipanAktif = Titipan::where('pengirim_id', $user->id)
            ->whereIn('status', ['menunggu', 'diterima', 'dijemput', 'dalam_perjalanan'])
            ->count();
        $titipanSelesai = Titipan::where('pengirim_id', $user->id)->where('status', 'selesai')->count();

        $titipanTerbaru = Titipan::with(['perjalanan.traveler'])
            ->where('pengirim_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $perjalananTersedia = Perjalanan::with('traveler')
            ->where('status', 'tersedia')
            ->where('user_id', '!=', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('pengirim.dashboard', compact(
            'totalTitipan',
            'titipanAktif',
            'titipanSelesai',
            'titipanTerbaru',
            'perjalananTersedia'
        ));
    }
}