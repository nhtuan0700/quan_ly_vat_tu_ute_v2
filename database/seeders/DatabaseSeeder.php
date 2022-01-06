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
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            DepartmentSeeder::class,
            // CategorySeeder::class,
            // StationerySeeder::class,
            // EquipmentSeeder::class,
            RolePermissionSeeder::class,
            PositionSeeder::class,
            UserSeeder::class,
        ]);
    }
}
