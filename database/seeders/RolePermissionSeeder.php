<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_permission')->truncate();
        $admin = ['user-manage', 'permission-manage', 'vattu-manage', 'dk-manage', 'hanmuc-manage'];
        foreach ($admin as $item) {
            $permission = Permission::where('name', $item)->first()->id;
            Role::find(1)->permissions()->attach($permission);
        }
        $csvc = ['phieu-confirm', 'phieubangiao-manage'];
        foreach ($csvc as $item) {
            $permission = Permission::where('name', $item)->first()->id;
            Role::find(2)->permissions()->attach($permission);
        }
        $qlvt = ['phieumua-manage', 'dk-confirm'];
        foreach ($qlvt as $item) {
            $permission = Permission::where('name', $item)->first()->id;
            Role::find(3)->permissions()->attach($permission);
        }
    }
}
