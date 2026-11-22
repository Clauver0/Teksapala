<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dokumentasi', function (Blueprint $table) {
            // Rename kolom sesuai kebutuhan baru
            $table->renameColumn('file_foto', 'link_gdrive');
            $table->renameColumn('judul_foto', 'judul_dokumentasi');
        });

        Schema::table('dokumentasi', function (Blueprint $table) {
            // Pastikan panjang string cukup untuk link GDrive & judul dokumentasi
            $table->string('link_gdrive', 500)->change();
            $table->string('judul_dokumentasi', 150)->change();

            // Enforce relasi One-to-One: 1 jadwal hanya boleh punya 1 dokumentasi
            $table->unique('id_jadwal', 'dokumentasi_id_jadwal_unique');
        });
    }

    public function down(): void
    {
        Schema::table('dokumentasi', function (Blueprint $table) {
            $table->dropUnique('dokumentasi_id_jadwal_unique');
        });

        Schema::table('dokumentasi', function (Blueprint $table) {
            $table->string('file_foto', 255)->change();
            $table->string('judul_foto', 150)->change();
        });

        Schema::table('dokumentasi', function (Blueprint $table) {
            $table->renameColumn('link_gdrive', 'file_foto');
            $table->renameColumn('judul_dokumentasi', 'judul_foto');
        });
    }
};