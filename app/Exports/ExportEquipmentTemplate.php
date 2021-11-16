<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportEquipmentTemplate implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [];
    }

    public function headings() : array {
        return [
            'ID',
            'Tên',
            'Phòng',    
            'Ngày Mua',
            'Ngày Cấp'
        ];
    }
}
