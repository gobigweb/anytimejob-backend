<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatusTableDataSeeder::class);
        $this->call(RoleTableDataSeeder::class);
        $this->call(PermissionTableDataSeeder::class);

    }
}
