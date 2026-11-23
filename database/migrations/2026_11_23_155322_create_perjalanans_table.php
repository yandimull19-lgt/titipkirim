<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perjalanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('kota_asal', 100);
            $table->string('kota_tujuan', 100);
            $table->date('tanggal_berangkat');
            $table->time('jam_berangkat')->nullable();
            $table->string('jenis_transportasi', 50);
            $table->decimal('kapasitas_kg', 6, 2);
            $table->decimal('tarif_per_kg', 12, 2);
            $table->string('status', 20)->default('tersedia');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perjalanans');
    }
};