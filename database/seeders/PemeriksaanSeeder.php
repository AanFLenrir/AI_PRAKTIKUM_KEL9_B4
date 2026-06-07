<?php

namespace Database\Seeders;

use App\Models\Balita;
use App\Models\Pemeriksaan;
use App\Models\User;
use Illuminate\Database\Seeder;

class PemeriksaanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil balita laki-laki pertama (Arkananta Putra)
        $balitaLaki = Balita::where('jenis_kelamin', 'L')->first();
        // Ambil balita perempuan pertama (Binar Cahaya)
        $balitaPerempuan = Balita::where('jenis_kelamin', 'P')->first();

        // Ambil petugas/nakes pertama
        $nakes = User::role('tenaga-kesehatan')->first();

        if ($balitaLaki && $nakes) {
            // Pemeriksaan 1 (sesuai contoh di api_docs.md)
            $p1 = Pemeriksaan::create([
                'id_pemeriksaan' => 1,
                'tanggal_periksa' => '2026-05-15',
                'umur_bulan' => 12,
                'berat_badan' => 9.00,
                'tinggi_badan' => 65.00,
                'nilai_fuzzy' => 45.31,
                'imt' => 21.30,
                'kategori_bbu' => 'Berat badan normal',
                'kategori_pbu' => 'Normal',
                'kategori_bbpb' => 'Gizi baik (normal)',
                'kategori_imtu' => 'Gizi baik (normal)',
                'id_balita' => $balitaLaki->id_balita,
                'id_user' => $nakes->id,
                'id_status_gizi' => 1, // Gizi Buruk
            ]);
        }

        if ($balitaPerempuan && $nakes) {
            // Pemeriksaan 2 (data gizi normal)
            $p2 = Pemeriksaan::create([
                'id_pemeriksaan' => 2,
                'tanggal_periksa' => '2026-05-20',
                'umur_bulan' => 10,
                'berat_badan' => 8.50,
                'tinggi_badan' => 72.00,
                'nilai_fuzzy' => 57.00,
                'imt' => 16.40,
                'kategori_bbu' => 'Berat badan normal',
                'kategori_pbu' => 'Normal',
                'kategori_bbpb' => 'Gizi baik (normal)',
                'kategori_imtu' => 'Gizi baik (normal)',
                'id_balita' => $balitaPerempuan->id_balita,
                'id_user' => $nakes->id,
                'id_status_gizi' => 3, // Normal
            ]);
        }
    }
}
