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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->string('id_jadwal', 10)->primary();
            $table->string('status_pelaksanaan', 50)->nullable();
            $table->string('lokasi_pelaksanaan', 100)->nullable();
            $table->date('tanggal_pelaksanaan')->nullable();
            $table->string('deskripsi',255)->nullable();
            $table->string('id_komunitas', 10);
            $table->foreign('id_komunitas')->references('id_komunitas')->on('komunitas')->onDelete('cascade'); //foreignkey
            $table->integer('jumlah_peserta')->nullable();
            // tambahan agar bisa direstore
            $table->timestamp('deleted_at')->nullable();
            // tambahan karena ada sistem archive
            $table->boolean('is_archived')->default(0);
            $table->string('gambar',255)->nullable();

            $table->timestamps();
        });
    }

    /**`
     * Reverse the migrations.`
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
