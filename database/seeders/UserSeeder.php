<?php

namespace Database\Seeders;

use App\Repositories\User\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
                'cmnd' => '201201201',
                'email' => 'admin@ute.udn.vn',
                'password' => Hash::make('123123'),
                'id_role' => 1,
                'id_donvi' => 'PCSVC',
            ]
        ];

        $userRepo = new UserRepository();
        foreach ($data as $item) {
            $userRepo->create($item);
        }
    }
}
