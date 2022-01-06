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
            'Số điện thoại',
            'Ngày sinh',
            'Chứng minh nhân dân',
            'Đơn vị',
            'Chức vụ',
            'Vai trò',
        ];
    }

    public function map($user): array {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->tel,
            $user->dob,
            $user->id_card,
            $user->department->name,
            optional($user->position)->name,
            $user->role->name,
        ];
    }
}
