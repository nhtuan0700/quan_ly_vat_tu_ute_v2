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
                'name' => 'Khoa Điện - Điện Tử',
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
            [
                'id' => 'PKHTC',
                'name' => 'Phòng Kế Hoạch Tài Chính',
            ],
            [
                'id' => 'PTCHC',
                'name' => 'Phòng Tổ Chức Hành Chính',
            ],
            [
                'id' => 'PQLKH',
                'name' => 'Phòng QLKH và HTQT',
            ],
        ];
        DB::table('department')->insert($data);
    }
}
