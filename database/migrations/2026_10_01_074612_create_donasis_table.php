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
            $table->string('ID_DONASI', 10)-> primary();
            $table->decimal('NOMINAL_DONASI', 12 , 2);
            $table->dateTime('WAKTU_DONASI', 10);
            $table->string('METODE_DONASI', 50);
            $table->enum('STATUS_VERIFIKASI', ['Terverifikasi','Pending','Ditolak'])->default('Pending');
            $table->string('BUKTI_DONASI', 255);
            $table->string('FILE_SERTIFIKAT', 255)->nullable();
            $table->string('ID_DONATUR', 10);
            $table->foreign('ID_DONATUR', 10)->references('ID_DONATUR')->on('donatur')->onDelete('cascade'); //foreignkey
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





// <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('donatur', function (Blueprint $table) {
//             $table->string('ID_DONATUR', 10)->primary();
//             $table->string('NAMA_LENGKAP', 100);
//             $table->string('EMAIL', 100)->unique('DONATUR_EMAIL_UN');
//             $table->string('USERNAME', 50)->unique('DONATUR_USERNAME_UN');
//             $table->string('PASSWORD', 255);
//             $table->string('NO_TELP', 20)->nullable();
//             $table->timestamps();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('donatur');
//     }
// };
