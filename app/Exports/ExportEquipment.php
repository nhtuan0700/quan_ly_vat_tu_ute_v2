<?php

namespace App\Exports;

use App\Models\Equipment;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportEquipment implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Equipment::all();
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

    public function map($thietbi): array {
        return [
            $thietbi->id,
            $thietbi->name,
            $thietbi->room,
            $thietbi->date_buy,
            $thietbi->date_grant
        ];
    }
}
