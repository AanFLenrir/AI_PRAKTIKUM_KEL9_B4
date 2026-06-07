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
        Schema::create('detail_hasil_fuzzy', function (Blueprint $col) {
            $col->id('id_detail');
            $col->string('rule_aktif', 255);
            $col->decimal('alpha_predikat', 4, 3); // Contoh nilai: 0.750
            $col->decimal('nilai_defuzzy', 5, 2);  // Contoh nilai: 75.30
            
            $col->foreignId('id_pemeriksaan')->constrained('pemeriksaan', 'id_pemeriksaan')->onDelete('cascade');
            $col->foreignId('id_rule')->constrained('rules_fuzzy', 'id_rule')->onDelete('cascade');
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_hasil_fuzzy');
    }
};
