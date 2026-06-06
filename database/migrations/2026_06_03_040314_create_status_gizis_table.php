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
        Schema::create('status_gizi', function (Blueprint $col) {
            $col->id('id_status_gizi');
            $col->string('nama_status', 50);
            $col->text('keterangan')->nullable();
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_gizi');
    }
};
