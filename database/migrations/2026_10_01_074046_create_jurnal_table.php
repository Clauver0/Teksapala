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
        Schema::create('jurnal', function (Blueprint $table) {
            $table->string('id_jurnal',10)->primary()->nullable(false);
             
            // Relasi ke tabel komunitas
            $table->string('id_komunitas', 10);

            $table->string('judul_jurnal',100)->nullable(false);
            $table->string('jenis_tanaman',100)->nullable(false);
            $table->text('deskripsi')->nullable();
            $table->string('gambar', 255)->nullable();
            $table->date('tanggal_jurnal')->nullable(false);
            $table->timestamps();

            // Foreign key
            $table->foreign('id_komunitas')
                  ->references('id_komunitas')
                  ->on('komunitas')
                  ->onDelete('restrict');
        
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal');
    }
};
