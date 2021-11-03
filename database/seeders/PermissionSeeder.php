<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
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
                'name' => 'permission-manage',
                'description' => 'Phân quyền'
            ],
            [
                'name' => 'user-manage',
                'description' => 'Quản lý tài khoản hệ thống'
            ],
            [
                'name' => 'vattu-manage',
                'description' => 'Quản lý vật tư'
            ],
            [
                'name' => 'dk-manage',
                'description' => 'Quản lý đợt đăng ký văn phòng phẩm'
            ],
            [
                'name' => 'hanmuc-manage',
                'description' => 'Quản lý hạn mức'
            ],
            [
                'name' => 'phieu-confirm',
                'description' => 'Xét duyệt phiếu đề nghị'
            ],
            [
                'name' => 'phieubangiao-manage',
                'description' => 'Quản lý phiếu bàn giao'
            ],
            [
                'name' => 'phieumua-manage',
                'description' => 'Quản lý phiếu mua'
            ],
            [
                'name' => 'dk-confirm',
                'description' => 'Bàn giao văn phòng phẩm đăng ký'
            ],
        ];

        DB::table('permission')->insert($data);
    }
}
