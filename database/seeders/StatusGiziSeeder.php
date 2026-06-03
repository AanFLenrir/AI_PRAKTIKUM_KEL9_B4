<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusGiziSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_status_gizi' => 1,
                'nama_status' => 'Gizi Buruk',
                'keterangan' => 'Kondisi gizi sangat rendah yang menunjukkan kekurangan berat badan atau energi secara berat dan memerlukan penanganan segera.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_status_gizi' => 2,
                'nama_status' => 'Gizi Kurang',
                'keterangan' => 'Kondisi gizi di bawah normal yang menunjukkan adanya kekurangan asupan gizi sehingga perlu pemantauan dan perbaikan pola makan.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_status_gizi' => 3,
                'nama_status' => 'Normal',
                'keterangan' => 'Kondisi gizi sesuai dengan standar pertumbuhan anak berdasarkan usia dan ukuran tubuh.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_status_gizi' => 4,
                'nama_status' => 'Gizi Lebih',
                'keterangan' => 'Kondisi gizi di atas normal yang menunjukkan kelebihan berat badan dan berisiko menimbulkan masalah kesehatan.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_status_gizi' => 5,
                'nama_status' => 'Obesitas',
                'keterangan' => 'Kondisi penumpukan lemak tubuh berlebih yang dapat meningkatkan risiko penyakit dan gangguan pertumbuhan.',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('status_gizi')->insert($data);
    }
}
