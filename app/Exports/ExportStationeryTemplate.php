<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportStationeryTemplate implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [];
    }

    public function headings() : array {
        return [
            'Tên',
            'Đơn vị tính',    
        ];
    }
}
