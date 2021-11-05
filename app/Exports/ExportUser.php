<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportUser implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    public function headings() : array {
        return [
            'ID',
            'Họ Tên',
            'Email',    
            'Password',
            'Số điện thoại',
            'Ngày sinh',
            'Chứng minh nhân dân',
            'Vai trò',
            'Đơn vị'
        ];
    }

    public function map($user): array {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->password,
            $user->tel,
            $user->dob,
            $user->cmnd,
            $user->role->name,
            $user->donvi->name
        ];
    }
}
