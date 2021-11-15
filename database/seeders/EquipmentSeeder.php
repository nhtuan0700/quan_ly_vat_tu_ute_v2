<?php

namespace Database\Seeders;

use App\Repositories\ThietBi\ThietBiRepository;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
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
                'name' => 'Màn hình Dell',
                'room' => 'Phòng thực hành máy tính số 1'
            ],
            [
                'name' => 'Màn hình Dell',
                'room' => 'Phòng thực hành máy tính số 1'
            ],
            [
                'name' => 'Màn hình Dell',
                'room' => 'Phòng thực hành máy tính số 1'
            ],
            [
                'name' => 'Chuột logitech',
                'room' => 'Phòng thực hành máy tính số 1'
            ],
            [
                'name' => 'Chuột logitech',
                'room' => 'Phòng thực hành máy tính số 1'
            ],
            [
                'name' => 'Chuột logitech',
                'room' => 'Phòng thực hành máy tính số 1'
            ],
            [
                'name' => 'Máy chiếu',
                'room' => 'Phòng thực hành máy tính số 1'
            ],
            [
                'name' => 'Máy chiếu',
                'room' => 'Phòng thực hành máy tính số 2'
            ],
            [
                'name' => 'Máy chiếu',
                'room' => 'Phòng thực hành máy tính số 3'
            ],
        ];

        // $thietBiRepo = new ThietBiRepository;
        // foreach ($data as $item) {
        //     $thietBiRepo->create($item);
        // }
    }
}
