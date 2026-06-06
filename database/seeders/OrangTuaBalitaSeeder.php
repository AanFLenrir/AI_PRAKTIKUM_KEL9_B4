<?php

namespace Database\Seeders;

use App\Models\Balita;
use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrangTuaBalitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dataset Orang Tua & Balitanya (Dicocokkan berdasarkan email user eksisting)
        $dataset = [
            [
                'email' => 'dian.kartika@gmail.com',
                'profile' => ['alamat' => 'Jl. Ketintang No. 12, Surabaya', 'no_hp' => '081234567890'],
                'balita' => [
                    ['nama_balita' => 'Arkananta Putra', 'jenis_kelamin' => 'L', 'tanggal_lahir' => '2024-05-10'],
                    ['nama_balita' => 'Binar Cahaya', 'jenis_kelamin' => 'P', 'tanggal_lahir' => '2025-08-15']
                ]
            ],
            [
                'email' => 'ahmad.fauzi@gmail.com',
                'profile' => ['alamat' => 'Jl. Dharmahusada Indah No. 45, Surabaya', 'no_hp' => '082134567811'],
                'balita' => [
                    ['nama_balita' => 'Candra Wijaya', 'jenis_kelamin' => 'L', 'tanggal_lahir' => '2023-11-20']
                ]
            ],
            [
                'email' => 'rina.lestari@gmail.com',
                'profile' => ['alamat' => 'Griya Mapan Sentosa Blok F-9, Sidoarjo', 'no_hp' => '083845678922'],
                'balita' => [
                    ['nama_balita' => 'Danish Rizqi', 'jenis_kelamin' => 'L', 'tanggal_lahir' => '2024-01-05'],
                    ['nama_balita' => 'Elira Naura', 'jenis_kelamin' => 'P', 'tanggal_lahir' => '2025-10-12']
                ]
            ],
            [
                'email' => 'rizky.p@gmail.com',
                'profile' => ['alamat' => 'Jl. Rungkut Madya No. 102, Surabaya', 'no_hp' => '085734567833'],
                'balita' => [
                    ['nama_balita' => 'Faza Ramadhan', 'jenis_kelamin' => 'L', 'tanggal_lahir' => '2024-03-25']
                ]
            ],
            [
                'email' => 'eka.yuliana@gmail.com',
                'profile' => ['alamat' => 'Jl. Gubeng Kertajaya Gang V No. 3, Surabaya', 'no_hp' => '081934567844'],
                'balita' => [
                    ['nama_balita' => 'Gisha Aqila', 'jenis_kelamin' => 'P', 'tanggal_lahir' => '2025-02-18']
                ]
            ],
        ];
        foreach ($dataset as $data) {
            // 1. Cari user yang sudah ada berdasarkan email
            $user = User::where('email', $data['email'])->first();
            // Antisipasi jika user tidak ditemukan di database agar seeder tidak crash
            if ($user) {
                
                // Pastikan user tersebut memiliki role 'orang-tua' jika seeder user utama belum memasangnya
                if (!$user->hasRole('orang-tua')) {
                    $user->assignRole('orang-tua');
                }
                // 2. Buat profil Orang Tua (ID menyontek dari ID User yang ditemukan)
                $orangTua = OrangTua::updateOrCreate(
                    ['id' => $user->id], // Mencegah duplikasi jika seeder dijalankan ulang
                    [
                        'alamat' => $data['profile']['alamat'],
                        'no_hp' => $data['profile']['no_hp'],
                    ]
                );
                // 3. Masukkan data Balita terikat dengan ID Orang Tua tersebut
                foreach ($data['balita'] as $b) {
                    Balita::updateOrCreate(
                        [
                            'nama_balita' => $b['nama_balita'],
                            'id_orang_tua' => $orangTua->id
                        ],
                        [
                            'jenis_kelamin' => $b['jenis_kelamin'],
                            'tanggal_lahir' => $b['tanggal_lahir'],
                        ]
                    );
                }
            }
        }
    }
}
