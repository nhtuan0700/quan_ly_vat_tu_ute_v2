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
                'name' => 'user-manage',
                'description' => 'Quản lý tài khoản hệ thống'
            ],
            [
                'name' => 'vattu-manage',
                'description' => 'Quản lý vật tư'
            ],
            [
                'name' => 'vpp_time-manage',
                'description' => 'Quản lý thời gian đăng ký văn phòng phẩm'
            ],
            [
                'name' => 'hanmuc-manage',
                'description' => 'Quản lý hạn mức'
            ],
            [
                'name' => 'dk-vpp',
                'description' => 'Đăng ký văn phòng phẩm'
            ],
            [
                'name' => 'phieumua-view',
                'description' => 'Xem phiếu mua văn phòng phẩm'
            ],
            [
                'name' => 'phieumua-create',
                'description' => 'Tạo phiếu mua văn phòng phẩm'
            ],
            [
                'name' => 'phieumua-edit',
                'description' => 'Sửa phiếu mua văn phòng phẩm'
            ],
            [
                'name' => 'phieumua-delete',
                'description' => 'Xóa phiếu mua văn phòng phẩm'
            ],
            [
                'name' => 'phieusua-view',
                'description' => 'Xem phiếu sửa chữa thiết bị'
            ],
            [
                'name' => 'phieusua-create',
                'description' => 'Tạo phiếu sửa chữa thiết bị'
            ],
            [
                'name' => 'phieusua-edit',
                'description' => 'Sửa phiếu sửa chữa thiết bị'
            ],
            [
                'name' => 'phieusua-delete',
                'description' => 'Xóa phiếu sửa chữa thiết bị'
            ],
            [
                'name' => 'phieu-confirm',
                'description' => 'Xét duyệt phiếu đề nghị'
            ],
            [
                'name' => 'phieubangiao-view',
                'description' => 'Xem phiếu bàn giao'
            ],
            [
                'name' => 'phieubangiao-create',
                'description' => 'Tạo phiếu bàn giao'
            ],
            [
                'name' => 'phieubangiao-edit',
                'description' => 'Sửa phiếu bàn giao'
            ],
            [
                'name' => 'phieubangiao-delete',
                'description' => 'Xóa phiếu bàn giao'
            ],
        ];

        DB::table('permission')->insert($data);
    }
}
