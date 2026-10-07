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
        Schema::create('donasi', function (Blueprint $table) {
            $table->string('id_donasi', 10)-> primary();
            $table->decimal('nominal_donasi', 12 , 2);
            $table->dateTime('waktu_donasi');
            $table->string('metode_donasi', 50);
            $table->enum('status_verifikasi', ['Terverifikasi','Pending','Ditolak'])->default('Pending');
            $table->string('bukti_donasi', 255);
            $table->string('file_sertifikat', 255)->nullable();
            $table->string('id_donatur', 10);
            $table->foreign('id_donatur')->references('id_donatur')->on('donatur')->onDelete('cascade'); //foreignkey
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi');
    }
};
