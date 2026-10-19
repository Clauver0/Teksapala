<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komunitas', function (Blueprint $table) {
            $table->string('id_komunitas', 10)->primary();
            $table->string('nama_komunitas', 100)->nullable();
            $table->string('display_name', 100)->nullable();
            $table->string('peran', 50)->nullable();
            $table->string('email', 100)->nullable()->unique('komunitas_email_un');
            $table->string('username', 50)->unique('komunitas_username_un');
            $table->string('password', 255);
            $table->string('no_telp', 20)->nullable();
            $table->string('profile_img')->nullable();
            $table->string('header_img')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komunitas');
    }
};