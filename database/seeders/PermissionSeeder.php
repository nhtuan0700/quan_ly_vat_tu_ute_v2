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
                'name' => 'supplies-manage',
                'description' => 'Quản lý vật tư'
            ],
            [
                'name' => 'period-manage',
                'description' => 'Quản lý đợt đăng ký văn phòng phẩm'
            ],
            [
                'name' => 'limit-manage',
                'description' => 'Quản lý hạn mức'
            ],
            [
                'name' => 'request_note-process',
                'description' => 'Xử lý phiếu đề nghị'
            ],
            [
                'name' => 'handover_note-manage',
                'description' => 'Quản lý phiếu bàn giao'
            ],
            [
                'name' => 'buy_note-manage',
                'description' => 'Quản lý phiếu mua'
            ],
            [
                'name' => 'registration-handover',
                'description' => 'Bàn giao văn phòng phẩm đăng ký'
            ],
            [
                'name' => 'statistic',
                'description' => 'Thống kê'
            ],
            [
                'name' => 'limit-process',
                'description' => 'Xử lý cập nhật hạn mức'
            ],
        ];

        DB::table('permission')->insert($data);
    }
}
