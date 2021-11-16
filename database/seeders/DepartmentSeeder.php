<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
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
            ],
            [
                'id' => 'KXD',
                'name' => 'Khoa Kỹ Thuật Xây Dựng',
            ],
            [
                'id' => 'KCK',
                'name' => 'Khoa Cơ Khí',
            ],
            [
                'id' => 'KCNHH',
                'name' => 'Khoa Công Nghệ Hóa Học - Môi Trường',
            ],
            [
                'id' => 'KSPCN',
                'name' => 'Khoa Sư Phạm Công Nghiệp',
            ],
            [
                'id' => 'PCSVC',
                'name' => 'Phòng Cơ Sở Vật Chất',
            ],
            [
                'id' => 'PDT',
                'name' => 'Phòng Đào Tạo',
            ],
            [
                'id' => 'PCTSV',
                'name' => 'Phòng Công Tác Sinh Viên',
            ],
        ];
        DB::table('department')->insert($data);
    }
}
