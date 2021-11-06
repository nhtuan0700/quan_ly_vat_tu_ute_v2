<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUserTemplate implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        return [];
    }

    public function headings(): array
    {
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
}
