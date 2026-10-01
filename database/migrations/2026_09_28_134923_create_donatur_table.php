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
        Schema::create('donatur', function (Blueprint $table) {
            $table->string('ID_DONATUR', 10)->primary();
            $table->string('NAMA_LENGKAP', 100);
            $table->string('EMAIL', 100)->unique('DONATUR_EMAIL_UN');
            $table->string('USERNAME', 50)->unique('DONATUR_USERNAME_UN');
            $table->string('PASSWORD', 255);
            $table->string('NO_TELP', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donatur');
    }
};
