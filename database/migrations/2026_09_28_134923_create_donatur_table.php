<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donatur', function (Blueprint $table) {
            $table->string('id_donatur', 10)->primary();
            $table->string('nama_lengkap', 100)->nullable();   // diisi nanti, registrasi cuma butuh username & password
            $table->string('display_name', 100)->nullable();   // dipakai di halaman profil
            $table->string('email', 100)->nullable()->unique('donatur_email_un');
            $table->string('username', 50)->unique('donatur_username_un');
            $table->string('password', 255);
            $table->string('no_telp', 20)->nullable();
            $table->string('profile_img')->nullable();        // path di storage/public
            $table->string('header_img')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donatur');
    }
};