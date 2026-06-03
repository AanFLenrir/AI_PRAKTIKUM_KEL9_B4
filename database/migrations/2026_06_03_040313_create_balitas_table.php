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
        Schema::create('balita', function (Blueprint $col) {
            $col->id('id_balita');
            $col->string('nama_balita', 100);
            $col->enum('jenis_kelamin', ['L', 'P']);
            $col->date('tanggal_lahir');
            // Foreign Key merujuk ke orang_tua.id
            $col->foreignId('id_orang_tua')->constrained('orang_tua', 'id')->onDelete('cascade');
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balita');
    }
};
