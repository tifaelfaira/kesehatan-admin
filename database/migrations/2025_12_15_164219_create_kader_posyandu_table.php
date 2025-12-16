<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kader_posyandu', function (Blueprint $table) {
            $table->id('kader_id');

            $table->unsignedBigInteger('posyandu_id');
            $table->unsignedBigInteger('warga_id');

            $table->string('peran', 100);
            $table->date('mulai_tugas');
            $table->date('akhir_tugas')->nullable();

            $table->timestamps();

            // ===== FOREIGN KEY BENAR =====

            $table->foreign('posyandu_id')
                  ->references('posyandu_id')
                  ->on('posyandu')
                  ->onDelete('cascade');

            // 🔥 INI YANG KEMARIN SALAH
            $table->foreign('warga_id')
                  ->references('id') // <-- HARUS id
                  ->on('warga')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kader_posyandu');
    }
};
