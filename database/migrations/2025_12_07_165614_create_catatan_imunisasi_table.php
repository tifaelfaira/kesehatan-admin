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
         Schema::create('catatan_imunisasi', function (Blueprint $table) {
            $table->id('imunisasi_id');
            $table->foreignId('warga_id')->constrained('warga')->onDelete('cascade');
            $table->string('jenis_vaksin', 100);
            $table->date('tanggal');
            $table->string('lokasi', 100)->nullable();
            $table->string('nakes', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('catatan_imunisasi');
    }
};
