<?php

namespace App\Exports;

use App\Models\Stationery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportStationery implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Stationery::all();
    }

    public function headings() : array {
        return [
            'Tên',
            'Đơn vị tính',    
            'Hạn mức TB',
        ];
    }

    public function map($vpp): array {
        return [
            $vpp->name,
            $vpp->unit,
            $vpp->limit_avg,
        ];
    }
}
