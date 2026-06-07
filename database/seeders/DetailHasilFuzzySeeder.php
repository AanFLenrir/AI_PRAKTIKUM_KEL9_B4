<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailHasilFuzzySeeder extends Seeder
{
    public function run(): void
    {
        $details = [
            // Detail hasil pemeriksaan ID 1 (Arkananta Putra, Gizi Buruk)
            [
                'rule_aktif' => 'IF Umur=Fase_3 AND BB=Ringan AND TB=Agak Panjang AND Imunisasi=Tidak Lengkap THEN StatusGizi=Gizi Buruk',
                'alpha_predikat' => 0.333,
                'nilai_defuzzy' => 45.31,
                'id_pemeriksaan' => 1,
                'id_rule' => 58,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rule_aktif' => 'IF Umur=Fase_3 AND BB=Sedang AND TB=Agak Panjang AND Imunisasi=Tidak Lengkap THEN StatusGizi=Normal',
                'alpha_predikat' => 0.333,
                'nilai_defuzzy' => 45.31,
                'id_pemeriksaan' => 1,
                'id_rule' => 67,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rule_aktif' => 'IF Umur=Fase_4 AND BB=Ringan AND TB=Agak Panjang AND Imunisasi=Tidak Lengkap THEN StatusGizi=Gizi Buruk',
                'alpha_predikat' => 0.667,
                'nilai_defuzzy' => 45.31,
                'id_pemeriksaan' => 1,
                'id_rule' => 85,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rule_aktif' => 'IF Umur=Fase_4 AND BB=Sedang AND TB=Agak Panjang AND Imunisasi=Tidak Lengkap THEN StatusGizi=Normal',
                'alpha_predikat' => 0.333,
                'nilai_defuzzy' => 45.31,
                'id_pemeriksaan' => 1,
                'id_rule' => 94,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('detail_hasil_fuzzy')->insert($details);
    }
}
