<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;

class PermissionTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'view_users'],
            ['name' => 'edit_user'],
            ['name' => 'view_roles'],
            ['name' => 'edit_roles'],
        ];

        DB::table('permissions')->insert($data);
    }
}
