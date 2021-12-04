<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationerySeeder extends Seeder
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
                'unit' => 'Ram',
                'limit_avg' => 2,
                'id_category' => 2
            ],
            [
                'name' => 'Phấn viên',
                'unit' => 'Hộp',
                'limit_avg' => 4,
                'id_category' => 4
            ],
            [
                'name' => 'Bút bi xanh',
                'unit' => 'Hộp',
                'limit_avg' => 1,
                'id_category' => 1
            ],
            [
                'name' => ' Bìa đựng hồ sơ',
                'unit' => 'Cái',
                'limit_avg' => 4,
                'id_category' => 3
            ],
            [
                'name' => 'Bấm ghim giấy',
                'unit' => 'Cái',
                'limit_avg' => 1,
                'id_category' => 2
            ],
            [
                'name' => 'Kẹp giấy 15 mm',
                'unit' => 'Hộp',
                'limit_avg' => 2,
                'id_category' => 2
            ],
            [
                'name' => 'Bút xóa nước',
                'unit' => 'Cái',
                'limit_avg' => 1,
                'id_category' => 1
            ],
        ];

        DB::table('stationery')->insert($data);
    }
}
