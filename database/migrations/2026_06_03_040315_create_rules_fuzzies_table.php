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
        Schema::create('rules_fuzzy', function (Blueprint $col) {
            $col->id('id_rule');
            $col->string('fase_umur', 50);
            $col->string('kategori_berat', 50);
            $col->string('kategori_tinggi', 50);
            $col->string('kategori_imunisasi', 50);
            $col->string('hasil_status_gizi', 50);
            $col->timestamps();
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
