<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuleFuzzySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            // === ATURAN FASE_1 ===
            ['id_rule' => 1, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 2, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 3, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 4, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 5, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 6, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 7, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 8, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 9, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 10, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 11, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 12, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 13, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 14, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 15, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 16, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 17, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 18, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 19, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 20, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 21, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 22, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 23, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 24, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 25, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 26, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 27, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],

            // === ATURAN FASE_2 ===
            ['id_rule' => 28, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 29, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 30, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 31, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 32, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 33, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 34, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 35, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 36, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 37, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 38, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 39, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 40, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 41, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 42, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 43, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 44, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 45, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 46, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 47, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 48, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 49, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 50, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 51, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 52, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 53, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 54, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],

            // === ATURAN FASE_3 ===
            ['id_rule' => 55, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 56, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 57, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 58, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 59, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 60, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 61, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 62, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 63, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 64, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 65, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 66, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 67, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 68, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 69, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 70, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 71, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 72, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 73, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 74, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 75, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 76, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 77, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 78, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 79, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 80, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 81, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],

            // === ATURAN FASE_4 ===
            ['id_rule' => 82, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 83, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 84, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 85, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 86, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 87, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 88, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 89, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 90, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 91, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 92, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 93, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 94, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 95, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 96, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 97, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 98, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 99, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 100, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 101, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 102, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 103, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 104, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 105, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 106, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 107, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 108, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],

            // === ATURAN FASE_5 ===
            ['id_rule' => 109, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 110, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 111, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 112, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 113, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 114, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 115, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 116, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 117, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 118, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 119, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 120, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 121, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 122, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 123, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 124, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 125, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 126, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 127, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 128, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 129, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 130, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 131, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 132, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 133, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 134, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 135, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],

        ];
        foreach ($rules as $rule) {
            $rule['created_at'] = now();
            $rule['updated_at'] = now();
            DB::table('rules_fuzzy')->insert($rule);
        }
    }
}
