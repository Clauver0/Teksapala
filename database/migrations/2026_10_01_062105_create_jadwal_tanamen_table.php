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
        Schema::create('jadwal_tanaman', function (Blueprint $table) {
            $table->string('id_jadwal_tanaman',10)->primary();
            $table->decimal('harga',10,2);
            $table->integer('kouta');
            $table->integer('terdonasi')->default(0);
           
            $table->string('id_jadwal', 10); 
            $table->string('id_tanaman', 10);

            $table->timestamps();
            $table->foreign('id_tanaman')
              ->references('id_tanaman')
              ->on('tanaman')
              ->onDelete('cascade');

            // $table->foreign('id_jadwal')
            //     ->references('id_jadwal')
            //     ->on('jadwal')
            //     ->onDelete('cascade');
              
        });
    }

    /**
     * Reverse the migrations.
     */
   public function down(): void
    {
        Schema::dropIfExists('jadwal_tanaman');
    }
};
