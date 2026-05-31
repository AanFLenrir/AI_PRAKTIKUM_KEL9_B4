<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ====================== ROLE AND PERMISSION =========================== //
        // 1. Reset cached roles and permissions bawaan Spatie biar tidak nyangkut
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Definisi Seluruh Permission (Verb)
        $permissions = [
            // Fitur Balita
            'view-own-balita',
            'view-any-balita',
            'create-balita',
            'update-own-balita',
            'update-any-balita',
            'delete-balita',

            // Fitur Pemeriksaan & FIS
            'view-own-pemeriksaan',
            'view-any-pemeriksaan',
            'create-pemeriksaan',
            'delete-pemeriksaan',

            // Fitur Manajemen Master Data
            'manage-imunisasi',
            'manage-status-gizi',
            'manage-rules-fuzzy',
        ];

        // Mass insert/create permissions ke database
        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        // 3. Definisi Role (Noun) dan Pemetaan Hak Akses
        // --- Role: Orang Tua ---
        $orangTuaRole = Role::findOrCreate('orang-tua');
        $orangTuaRole->givePermissionTo([
            'view-own-balita',
            'create-balita',
            'update-own-balita',
            'view-own-pemeriksaan',
            'create-pemeriksaan',
        ]);
        // --- Role: Tenaga Kesehatan ---
        $nakesRole = Role::findOrCreate('tenaga-kesehatan');
        $nakesRole->givePermissionTo([
            'view-any-balita',
            'create-balita',
            'update-any-balita',
            'view-any-pemeriksaan',
            'create-pemeriksaan',
        ]);
        // --- Role: Admin ---
        $adminRole = Role::findOrCreate('admin');

        // Admin otomatis mendapatkan SEMUA permission yang terdaftar di atas
        $adminRole->givePermissionTo(Permission::all());
        // ========================= END ================================= //
    }
}
