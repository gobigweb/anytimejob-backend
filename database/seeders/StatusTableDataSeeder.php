<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
Use DB;

class StatusTableDataSeeder extends Seeder
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
                'name'=>'Active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name'=>'Pending',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name'=>'Inactive',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name'=>'Blocked',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];
        DB::table('statuses')->insert($data);

    }
}
