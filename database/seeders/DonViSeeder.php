<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonViSeeder extends Seeder
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
                'id' => 'KD',
                'name' => 'Khoa Điện',
                'is_khoa' => true,
            ],
            [
                'id' => 'KXD',
                'name' => 'Khoa Kỹ Thuật Xây Dựng',
                'is_khoa' => true,
            ],
            [
                'id' => 'KCK',
                'name' => 'Khoa Cơ Khí',
                'is_khoa' => true,
            ],
            [
                'id' => 'KCNHH',
                'name' => 'Khoa Công Nghệ Hóa Học - Môi Trường',
                'is_khoa' => true,
            ],
            [
                'id' => 'KSPCN',
                'name' => 'Khoa Sư Phạm Công Nghiệp',
                'is_khoa' => true,
            ],
            [
                'id' => 'PCSVC',
                'name' => 'Phòng Cơ Sở Vật Chất',
                'is_khoa' => false,
            ],
            [
                'id' => 'PDT',
                'name' => 'Phòng Đào Tạo',
                'is_khoa' => false,
            ],
            [
                'id' => 'PCTSV',
                'name' => 'Phòng Công Tác Sinh Viên',
                'is_khoa' => false,
            ],
        ];
        DB::table('donvi')->insert($data);
    }
}
