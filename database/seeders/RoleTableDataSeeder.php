<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;

class RoleTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Admin',
            ],

            [
                'name' => 'User',
            ],
        ];

        DB::table('roles')->insert($data);
    }
}
