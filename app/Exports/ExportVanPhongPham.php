<?php

namespace App\Exports;

use App\Models\VanPhongPham;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportVanPhongPham implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return VanPhongPham::all();
    }

    public function headings() : array {
        return [
            'Tên',
            'Đơn vị tính',    
            'Hạn mức trung bình',
            'Danh mục'
        ];
    }

    public function map($vpp): array {
        return [
            $vpp->name,
            $vpp->dvt,
            $vpp->hanmuc_tb,
            $vpp->danhmuc->name,
        ];
    }
}
