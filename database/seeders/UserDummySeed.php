<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDummySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ====================== DUMMY USERS =========================== //
        // 1. DUMMY USER: ADMIN (1 User)
        $admin = User::create([
            'name' => 'Admin Pusat Sifuzi',
            'email' => 'admin@sifuzi.id',
            'password' => bcrypt('password123'),
        ]);
        $admin->assignRole('admin');

        // 2. DUMMY USER: TENAGA KESEHATAN (3 User)
        $dataNakes = [
            ['name' => 'Bidan Siti Aminah', 'email' => 'siti.aminah@sifuzi.id'],
            ['name' => 'Dr. Hendra Wijaya', 'email' => 'hendra.w@sifuzi.id'],
            ['name' => 'Sri Wahyuni (Kader)', 'email' => 'sri.wahyuni@sifuzi.id'],
        ];
        foreach ($dataNakes as $nakes) {
            $userNakes = User::create([
                'name' => $nakes['name'],
                'email' => $nakes['email'],
                'password' => bcrypt('nakes123'),
            ]);
            $userNakes->assignRole('tenaga-kesehatan');
        }

        // 3. DUMMY USER: ORANG TUA / WALI (5 User)
        $dataOrtu = [
            ['name' => 'Dian Kartika (Ibu)', 'email' => 'dian.kartika@gmail.com'],
            ['name' => 'Ahmad Fauzi (Ayah)', 'email' => 'ahmad.fauzi@gmail.com'],
            ['name' => 'Rina Lestari (Ibu)', 'email' => 'rina.lestari@gmail.com'],
            ['name' => 'Rizky Pratama (Ayah)', 'email' => 'rizky.p@gmail.com'],
            ['name' => 'Eka Yuliana (Ibu)', 'email' => 'eka.yuliana@gmail.com'],
        ];
        foreach ($dataOrtu as $ortu) {
            $userOrtu = User::create([
                'name' => $ortu['name'],
                'email' => $ortu['email'],
                'password' => bcrypt('ortu123'),
            ]);
            $userOrtu->assignRole('orang-tua');
        }
        // ========================= END ================================= //
    }
}
