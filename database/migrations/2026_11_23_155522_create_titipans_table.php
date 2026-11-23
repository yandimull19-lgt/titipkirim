<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('titipans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perjalanan_id')->constrained('perjalanans')->cascadeOnDelete();
            $table->foreignId('pengirim_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama_barang', 150);
            $table->text('deskripsi_barang')->nullable();
            $table->decimal('berat_kg', 6, 2);
            $table->string('nama_penerima', 100);
            $table->string('no_hp_penerima', 25);
            $table->text('alamat_penerima');
            $table->decimal('biaya_titip', 12, 2);
            $table->string('status', 30)->default('menunggu');
            $table->string('status_pembayaran', 20)->default('belum_bayar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('titipans');
    }
};