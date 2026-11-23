<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Titipan extends Model
{
    protected $fillable = [
        'perjalanan_id',
        'pengirim_id',
        'nama_barang',
        'deskripsi_barang',
        'berat_kg',
        'nama_penerima',
        'no_hp_penerima',
        'alamat_penerima',
        'biaya_titip',
        'status',
        'status_pembayaran',
        'metode_pembayaran',
        'tanggal_bayar',
    ];

    protected $casts = [
        'tanggal_bayar' => 'datetime',
    ];

    public function perjalanan(): BelongsTo
    {
        return $this->belongsTo(Perjalanan::class);
    }

    public function pengirim(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }
}