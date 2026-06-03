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
        Schema::create('pemeriksaan_imunisasi', function (Blueprint $col) {
            $col->foreignId('id_pemeriksaan')->constrained('pemeriksaan', 'id_pemeriksaan')->onDelete('cascade');
            $col->foreignId('id_imunisasi')->constrained('imunisasi', 'id_imunisasi')->onDelete('cascade');
            
            // Set gabungan berdua sebagai Primary Key biar tidak ada duplikasi data yang sama
            $col->primary(['id_pemeriksaan', 'id_imunisasi']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_imunisasi');
    }
};
