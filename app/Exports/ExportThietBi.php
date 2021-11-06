<?php

namespace App\Exports;

use App\Models\ThietBi;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportThietBi implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ThietBi::all();
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
            $thietbi->phong,
            $thietbi->ngay_mua,
            $thietbi->ngay_cap
        ];
    }
}
