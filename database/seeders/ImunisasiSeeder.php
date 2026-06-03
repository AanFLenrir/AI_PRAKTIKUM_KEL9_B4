<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImunisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id_imunisasi' => 1, 'nama_imunisasi' => 'Hepatitis B (HB0)', 'umur_bulan' => 0, 'keterangan_imunisasi' => 'Diberikan dalam 24 jam setelah lahir untuk mencegah infeksi virus hepatitis B.'],
            ['id_imunisasi' => 2, 'nama_imunisasi' => 'BCG', 'umur_bulan' => 1, 'keterangan_imunisasi' => 'Melindungi anak dari tuberkulosis (TB), terutama TB berat pada bayi dan anak.'],
            ['id_imunisasi' => 3, 'nama_imunisasi' => 'Polio 1', 'umur_bulan' => 1, 'keterangan_imunisasi' => 'Diberikan untuk mencegah penyakit polio yang dapat menyebabkan kelumpuhan permanen.'],
            ['id_imunisasi' => 4, 'nama_imunisasi' => 'DPT-HB-Hib 1', 'umur_bulan' => 2, 'keterangan_imunisasi' => 'Melindungi dari difteri, pertusis, tetanus, hepatitis B, dan infeksi Haemophilus influenzae tipe b.'],
            ['id_imunisasi' => 5, 'nama_imunisasi' => 'PCV 1', 'umur_bulan' => 2, 'keterangan_imunisasi' => 'Mencegah infeksi pneumokokus seperti pneumonia, meningitis, dan infeksi telinga.'],
            ['id_imunisasi' => 6, 'nama_imunisasi' => 'Rotavirus 1', 'umur_bulan' => 2, 'keterangan_imunisasi' => 'Melindungi bayi dari diare berat akibat infeksi rotavirus.'],
            ['id_imunisasi' => 7, 'nama_imunisasi' => 'DPT-HB-Hib 2', 'umur_bulan' => 3, 'keterangan_imunisasi' => 'Dosis lanjutan untuk memperkuat kekebalan terhadap difteri, pertusis, tetanus, hepatitis B, dan Hib.'],
            ['id_imunisasi' => 8, 'nama_imunisasi' => 'Polio 2', 'umur_bulan' => 3, 'keterangan_imunisasi' => 'Dosis lanjutan imunisasi polio untuk meningkatkan perlindungan.'],
            ['id_imunisasi' => 9, 'nama_imunisasi' => 'Rotavirus 2', 'umur_bulan' => 3, 'keterangan_imunisasi' => 'Dosis lanjutan imunisasi rotavirus.'],
            ['id_imunisasi' => 10, 'nama_imunisasi' => 'DPT-HB-Hib 3', 'umur_bulan' => 4, 'keterangan_imunisasi' => 'Dosis ketiga untuk membentuk kekebalan optimal terhadap penyakit sasaran.'],
            ['id_imunisasi' => 11, 'nama_imunisasi' => 'Polio 3', 'umur_bulan' => 4, 'keterangan_imunisasi' => 'Dosis lanjutan imunisasi polio.'],
            ['id_imunisasi' => 12, 'nama_imunisasi' => 'IPV', 'umur_bulan' => 4, 'keterangan_imunisasi' => 'Imunisasi polio suntik untuk meningkatkan perlindungan terhadap virus polio.'],
            ['id_imunisasi' => 13, 'nama_imunisasi' => 'PCV 2', 'umur_bulan' => 4, 'keterangan_imunisasi' => 'Dosis kedua vaksin pneumokokus.'],
            ['id_imunisasi' => 14, 'nama_imunisasi' => 'Rotavirus 3', 'umur_bulan' => 4, 'keterangan_imunisasi' => 'Dosis ketiga vaksin rotavirus (untuk jenis vaksin tertentu).'],
            ['id_imunisasi' => 15, 'nama_imunisasi' => 'Campak-Rubela (MR)', 'umur_bulan' => 9, 'keterangan_imunisasi' => 'Melindungi anak dari penyakit campak dan rubela.'],
            ['id_imunisasi' => 16, 'nama_imunisasi' => 'PCV Booster', 'umur_bulan' => 10, 'keterangan_imunisasi' => 'Dosis penguat vaksin pneumokokus untuk mempertahankan kekebalan.'],
            ['id_imunisasi' => 17, 'nama_imunisasi' => 'Japanese Encephalitis (JE)', 'umur_bulan' => 12, 'keterangan_imunisasi' => 'Melindungi dari penyakit radang otak akibat virus Japanese Encephalitis pada daerah endemis.'],
            ['id_imunisasi' => 18, 'nama_imunisasi' => 'DPT-HB-Hib Booster', 'umur_bulan' => 18, 'keterangan_imunisasi' => 'Dosis penguat untuk mempertahankan kekebalan terhadap penyakit sasaran.'],
            ['id_imunisasi' => 19, 'nama_imunisasi' => 'Campak-Rubela (MR) Booster', 'umur_bulan' => 18, 'keterangan_imunisasi' => 'Dosis penguat vaksin campak-rubela untuk menjaga kekebalan jangka panjang.']
        ];
        foreach ($data as $item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
            DB::table('imunisasi')->insert($item);
        }
    }
}
