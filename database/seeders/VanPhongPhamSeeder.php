<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VanPhongPhamSeeder extends Seeder
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
                'name' => 'Giấy A4',
                'dvt' => 'Ram',
                'hanmuc_tb' => 2,
                'id_danhmuc' => 2
            ],
            [
                'name' => 'Phấn viên',
                'dvt' => 'Hộp',
                'hanmuc_tb' => 4,
                'id_danhmuc' => 4
            ],
            [
                'name' => 'Bút bi xanh',
                'dvt' => 'Hộp',
                'hanmuc_tb' => 2,
                'id_danhmuc' => 1
            ],
            [
                'name' => ' Bìa đựng hồ sơ',
                'dvt' => 'Cái',
                'hanmuc_tb' => 5,
                'id_danhmuc' => 3
            ],
            [
                'name' => 'Bấm ghim giấy',
                'dvt' => 'Cái',
                'hanmuc_tb' => 5,
                'id_danhmuc' => 2
            ],
            [
                'name' => 'Kẹp giấy 15 mm',
                'dvt' => 'Hộp',
                'hanmuc_tb' => 5,
                'id_danhmuc' => 2
            ],
            [
                'name' => 'Bút xóa nước',
                'dvt' => 'Cái',
                'hanmuc_tb' => 2,
                'id_danhmuc' => 1
            ],
        ];

        DB::table('vanphongpham')->insert($data);
    }
}
