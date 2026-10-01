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
        Schema::create('komunitas', function (Blueprint $table) {
            $table->string('id_komunitas', 10)->primary();
            $table->string('peran', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('username', 50)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('no_telp', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komunitas');
    }
};