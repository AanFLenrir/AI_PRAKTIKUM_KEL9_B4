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
        Schema::create('orang_tua', function (Blueprint $col) {
            // PK sekaligus FK merujuk ke users.id (Relasi 1:1)
            $col->foreignId('id')->primary()->constrained('users')->onDelete('cascade');
            $col->text('alamat');
            $col->string('no_hp', 15);
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_tua');
    }
};
