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
                'is_room' => false
            ],
            [
                'name' => 'Phó trưởng khoa',
                'is_room' => false
            ],
            [
                'name' => 'Trưởng bộ môn',
                'is_room' => false
            ],
            [
                'name' => 'Phó trưởng bộ môn',
                'is_room' => false
            ],
            [
                'name' => 'Giảng viên',
                'is_room' => false
            ],
            [
                'name' => 'Chuyên viên',
            ],
            [
                'name' => 'Nhân viên',
            ]
        ];

        foreach ($positions as $position) {
            DB::table('position')->insert($position);
        }
    }
}
