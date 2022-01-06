<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            [
                'name' => 'Trưởng phòng',
            ],
            [
                'name' => 'Phó trưởng phòng',
            ],
            [
                'name' => 'Trưởng khoa',
            ],
            [
                'name' => 'Phó trưởng khoa',
            ],
            [
                'name' => 'Trưởng bộ môn',
            ],
            [
                'name' => 'Phó trưởng bộ môn',
            ],
            [
                'name' => 'Giảng viên',
            ],
            [
                'name' => 'Chuyên viên',
            ],
            [
                'name' => 'Nhân viên',
            ]
        ];

        DB::table('position')->insert($positions);
    }
}
