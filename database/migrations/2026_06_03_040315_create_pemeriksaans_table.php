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
        Schema::create('pemeriksaan', function (Blueprint $col) {
            $col->id('id_pemeriksaan');
            $col->date('tanggal_periksa');
            $col->integer('umur_bulan');
            $col->decimal('berat_badan', 5, 2); // Contoh: 12.35 kg
            $col->decimal('tinggi_badan', 5, 2); // Contoh: 85.50 cm
            $col->decimal('nilai_fuzzy', 5, 2)->nullable();
            $col->decimal('imt', 4, 2)->nullable();
            $col->enum('kategori_bbu', [
                'Berat badan sangat kurang (severely underweight)',
                'Berat badan kurang (underweight)',
                'Berat badan normal',
                'Risiko Berat badan lebih'
            ])->nullable();
            $col->enum('kategori_pbu', [
                'Sangat pendek (severely stunted)',
                'Pendek (stunted)',
                'Normal',
                'Tinggi'
            ])->nullable();
            $col->enum('kategori_bbpb', [
                'Gizi buruk (severely wasted)',
                'Gizi kurang (wasted)',
                'Gizi baik (normal)',
                'Berisiko gizi lebih (possible risk of overweight)',
                'Gizi lebih (overweight)',
                'Obesitas (obese)'
            ])->nullable();
            $col->enum('kategori_imtu', [
                'Gizi buruk (severely wasted)',
                'Gizi kurang (wasted)',
                'Gizi baik (normal)',
                'Berisiko gizi lebih (possible risk of overweight)',
                'Gizi lebih (overweight)',
                'Obesitas (obese)'
            ])->nullable();

            // Foreign Keys
            $col->foreignId('id_balita')->constrained('balita', 'id_balita')->onDelete('cascade');
            $col->foreignId('id_user')->constrained('users', 'id')->onDelete('cascade'); // Petugas/Nakes
            $col->foreignId('id_status_gizi')->constrained('status_gizi', 'id_status_gizi')->onDelete('cascade');

            $col->timestamps(); // Mengover CreatedAt & UpdatedAt otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
