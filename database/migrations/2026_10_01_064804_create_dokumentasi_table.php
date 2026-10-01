<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumentasi', function (Blueprint $table) {
            $table->string('id_dokumentasi', 10)->primary();
            $table->string('file_foto', 255);
            $table->string('judul_foto', 150);
            $table->timestamp('tanggal_unggah')->useCurrent();
            $table->text('deskripsi')->nullable();
            $table->string('id_jadwal', 10);
            $table->string('id_komunitas', 10);

            // Foreign Key Constraints
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal');
            $table->foreign('id_komunitas')->references('id_komunitas')->on('komunitas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumentasi');
    }
};
