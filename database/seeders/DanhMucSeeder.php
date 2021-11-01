<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DanhMucSeeder extends Seeder
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
                'name' => 'Bút'
            ],
            [
                'name' => 'Giấy'
            ],
            [
                'name' => 'Bìa'
            ],
            [
                'name' => 'Phấn'
            ]
        ];

        DB::table('danhmuc')->insert($data);
    }
}
