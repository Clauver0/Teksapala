<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void

    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->string('id_jadwal', 10)->primary();
            $table->string('status_pelaksanaan', 50)->nullable();
            $table->string('lokasi_pelaksanaan', 100)->nullable();
            $table->date('tanggal_pelaksanaan')->nullable();
            $table->string('deskripsi',255)->nullable();

             $table->timestamps();
        });
    }

    /**`
     * Reverse the migrations.`
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
