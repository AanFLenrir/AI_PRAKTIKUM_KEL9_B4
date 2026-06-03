<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rules_fuzzy', function (Blueprint $table) {
            $table->id('id_rule');

            $table->enum('fase_umur', [
                'Fase_1',
                'Fase_2',
                'Fase_3',
                'Fase_4',
                'Fase_5'
            ]);
            $table->enum('kategori_berat', [
                'Ringan',
                'Sedang',
                'Berat'
            ]);
            $table->enum('kategori_tinggi', [
                'Pendek',
                'Agak Panjang',
                'Panjang'
            ]);
            $table->enum('kategori_imunisasi', [
                'Tidak Lengkap',
                'Sebagian',
                'Lengkap'
            ]);
            $table->enum('hasil_status_gizi', [
                'Gizi Buruk',
                'Gizi Kurang',
                'Normal',
                'Gizi Lebih',
                'Obesitas'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules_fuzzy');
    }
};
