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
            // === ATURAN FASE 1 ===
            ['id_rule' => 1, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 2, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 3, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 4, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 5, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 6, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 7, 'fase_umur' => 'Fase_1', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],

            // === ATURAN FASE 2 ===
            ['id_rule' => 8, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 9, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 10, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 11, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 12, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 13, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 14, 'fase_umur' => 'Fase_2', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],

            // === ATURAN FASE 3 ===
            ['id_rule' => 15, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 16, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 17, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 18, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 19, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 20, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 21, 'fase_umur' => 'Fase_3', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],

            // === ATURAN FASE 4 ===
            ['id_rule' => 22, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 23, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 24, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 25, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 26, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 27, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 28, 'fase_umur' => 'Fase_4', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            
            // === ATURAN FASE 5 ===
            ['id_rule' => 29, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 30, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Agak Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Obesitas'],
            ['id_rule' => 31, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Berat', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Gizi Lebih'],
            ['id_rule' => 32, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Tidak Lengkap', 'hasil_status_gizi' => 'Gizi Buruk'],
            ['id_rule' => 33, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Sebagian', 'hasil_status_gizi' => 'Gizi Kurang'],
            ['id_rule' => 34, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Ringan', 'kategori_tinggi' => 'Pendek', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
            ['id_rule' => 35, 'fase_umur' => 'Fase_5', 'kategori_berat' => 'Sedang', 'kategori_tinggi' => 'Panjang', 'kategori_imunisasi' => 'Lengkap', 'hasil_status_gizi' => 'Normal'],
        ];
        foreach ($rules as $rule) {
            $rule['created_at'] = now();
            $rule['updated_at'] = now();
            DB::table('rules_fuzzy')->insert($rule);
        }
    }
}
