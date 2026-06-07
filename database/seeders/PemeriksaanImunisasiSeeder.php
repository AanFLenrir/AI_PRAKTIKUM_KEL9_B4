<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemeriksaanImunisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Pemeriksaan 1 (Arkananta Putra - Umur 12 Bulan)
            // Imunisasi yang direkomendasikan dan diterima hingga usia 12 bulan:
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 1],  // Hepatitis B (HB0) - 0 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 2],  // BCG - 1 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 3],  // Polio 1 - 1 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 4],  // DPT-HB-Hib 1 - 2 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 5],  // PCV 1 - 2 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 6],  // Rotavirus 1 - 2 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 7],  // DPT-HB-Hib 2 - 3 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 8],  // Polio 2 - 3 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 9],  // Rotavirus 2 - 3 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 10], // DPT-HB-Hib 3 - 4 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 11], // Polio 3 - 4 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 12], // IPV - 4 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 13], // PCV 2 - 4 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 14], // Rotavirus 3 - 4 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 15], // Campak-Rubela (MR) - 9 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 16], // PCV Booster - 10 Bulan
            ['id_pemeriksaan' => 1, 'id_imunisasi' => 17], // Japanese Encephalitis (JE) - 12 Bulan

            // Pemeriksaan 2 (Binar Cahaya - Umur 10 Bulan)
            // Imunisasi yang direkomendasikan dan diterima hingga usia 10 bulan:
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 1],  // Hepatitis B (HB0) - 0 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 2],  // BCG - 1 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 3],  // Polio 1 - 1 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 4],  // DPT-HB-Hib 1 - 2 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 5],  // PCV 1 - 2 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 6],  // Rotavirus 1 - 2 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 7],  // DPT-HB-Hib 2 - 3 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 8],  // Polio 2 - 3 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 9],  // Rotavirus 2 - 3 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 10], // DPT-HB-Hib 3 - 4 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 11], // Polio 3 - 4 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 12], // IPV - 4 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 13], // PCV 2 - 4 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 14], // Rotavirus 3 - 4 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 15], // Campak-Rubela (MR) - 9 Bulan
            ['id_pemeriksaan' => 2, 'id_imunisasi' => 16], // PCV Booster - 10 Bulan
        ];

        DB::table('pemeriksaan_imunisasi')->insertOrIgnore($data);
    }
}
