<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan_posyandu', function (Blueprint $table) {
            $table->id('layanan_id');
            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('warga_id');
            $table->float('berat');
            $table->float('tinggi');
            $table->string('vitamin');
            $table->text('konseling');
            $table->timestamps();

            // foreign key
            $table->foreign('jadwal_id')->references('jadwal_id')->on('jadwal_posyandu')->onDelete('cascade');
            $table->foreign('warga_id')->references('id')->on('warga')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan_posyandu');
    }
};