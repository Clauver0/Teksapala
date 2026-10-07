<?php

use App\Models\Donasi;
use App\Models\JadwalTanaman;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// isi tabel detail donasi: id_detail_donasi, jumlah_tanaman, id_donasi (FK), id_jadwal_tanaman (FK)
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_donasi', function (Blueprint $table) {
            $table->string('id_detail_donasi',10)-> primary();
            $table->integer('jumlah_tanaman');
            $table->string('id_donasi',10);
            $table->foreign('id_donasi')->references('id_donasi')->on('donasi')->onDelete('cascade');
            $table->string('id_jadwal_tanaman', 10);
            $table->foreign('id_jadwal_tanaman')->references('id_jadwal_tanaman')->on('Jadwal_tanaman')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_donasi');
    }
};

