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
        Schema::create('detail_donasis', function (Blueprint $table) {
            $table->string('ID_DETAIL_DONASI',10)-> primary();
            $table->integer('JUMLAH_TANAMAN');
            $table->string('ID_DONASI',10);
            $table->foreign('ID_DONASI')->references('ID_DONASI')->on('Donasi')->onDelete('cascade');
            $table->string('ID_JADWAL_TANAMAN', 10);
            $table->foreign('ID_JADWAL_TANAMAN')->references('ID_JADWAL_TANAMAN')->on('JadwalTanaman')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_donasis');
    }
};

