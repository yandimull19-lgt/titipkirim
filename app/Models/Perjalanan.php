<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perjalanan extends Model
{
    protected $fillable = [
        'user_id',
        'kota_asal',
        'kota_tujuan',
        'tanggal_berangkat',
        'jam_berangkat',
        'jenis_transportasi',
        'kapasitas_kg',
        'tarif_per_kg',
        'catatan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_berangkat' => 'date',
        ];
    }

    public function traveler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function titipan(): HasMany
    {
        return $this->hasMany(Titipan::class);
    }
}