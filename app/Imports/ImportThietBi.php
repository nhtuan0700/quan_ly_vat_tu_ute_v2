<?php

namespace App\Imports;

use App\Models\ThietBi;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportThietBi implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ThietBi([
            'id' => $row['0'],
            'name' => $row['1'],
            'phong' => $row['2'],
            'ngay_mua' => transformDateExcel($row['3']),
            'ngay_cap' => transformDateExcel($row['4']),
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
