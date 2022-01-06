<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
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
                'id' => 1,
                'name' => "Quản trị viên"
            ],
            [
                'id' => 2,
                'name' => "Nhân viên cơ sở vật chất"
            ],
            [
                'id' => 3,
                'name' => "Quản lý vật tư"
            ],
            [
                'id' => 4,
                'name' => "Người dùng"
            ],
            [
                'id' => 5,
                'name' => "Giám sát hạn mức"
            ],
        ];

        DB::table('role')->insert($data);
    }
}
