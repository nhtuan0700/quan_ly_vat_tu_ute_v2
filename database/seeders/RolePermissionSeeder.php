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
        $admin_permissions = ['user-manage', 'permission-manage', 'supplies-manage', 'period-manage', 'limit-manage'];
        foreach ($admin_permissions as $item) {
            $permission = Permission::where('name', $item)->first()->id;
            Role::find(1)->permissions()->attach($permission);
        }

        $handler_permissions = ['request_note-process', 'handover_note-manage', 'statistic'];
        foreach ($handler_permissions as $item) {
            $permission = Permission::where('name', $item)->first()->id;
            Role::find(2)->permissions()->attach($permission);
        }

        $manger_permissions = ['buy_note-manage', 'registration-handover'];
        foreach ($manger_permissions as $item) {
            $permission = Permission::where('name', $item)->first()->id;
            Role::find(3)->permissions()->attach($permission);
        }

        $manger_permissions = ['limit-process'];
        foreach ($manger_permissions as $item) {
            $permission = Permission::where('name', $item)->first()->id;
            Role::find(5)->permissions()->attach($permission);
        }
    }
}
