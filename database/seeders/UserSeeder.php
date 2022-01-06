<?php

namespace Database\Seeders;

use App\Repositories\User\UserInterface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => 'Nguyễn văn A',
                // 'dob' => '1977/1/1',
                'dob' => '1/1/1977',
                'tel' => '0123456789',
                'id_card' => '201201201',
                'email' => 'admin@ute.udn.vn',
                'password' => Hash::make('123123'),
                'id_role' => 1,
                'id_department' => 'PCSVC',
                'id_position' => 1,
            ],
            [
                'name' => 'Nguyễn Hữu Tuấn',
                // 'dob' => '1977/1/1',
                'dob' => '1/1/1977',
                'tel' => '0123456789',
                'id_card' => '201818606',
                'email' => '1811505310350@sv.ute.udn.vn',
                'password' => Hash::make('123123'),
                'id_role' => 5,
                'id_department' => 'PKHTC',
                'id_position' => 1,
            ]
        ];

        $userRepo = app(UserInterface::class);
        foreach ($data as $item) {
            $userRepo->create($item);
        }
    }
}
