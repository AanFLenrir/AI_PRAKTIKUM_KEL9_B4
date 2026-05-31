<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //! NOT WORKED !//
        $this->call([
            RolePermissionSeed::class,
            UserDummySeed::class
        ]);
        //! NOT WORKED !//

        //? TO COMPESATE
        //? Run one by one in CLI
    }
}
