<?php
namespace Database\Seeders;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use DB;

class RolePermissionTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionCount = Permission::count();
        $permissionRole = [];
        for ($i=1; $i <= $permissionCount; $i++) {
            $item = array(
                'role_id' => 1,
                'permission_id' => $i
            );
            $permissionRole[] = $item;
        }
        DB::table('role_permissions')->insert($permissionRole);
        $data = [
            ['role_id'=>2,'permission_id'=>1],
        ];
        DB::table('role_permissions')->insert($data);

    }
}
