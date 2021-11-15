<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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
                'id' => 1,
                'name' => 'Bút'
            ],
            [
                'id' => 2,
                'name' => 'Giấy'
            ],
            [
                'id' => 3,
                'name' => 'Bìa'
            ],
            [
                'id' => 4,
                'name' => 'Phấn'
            ]
        ];

        DB::table('category')->insert($data);
    }
}
