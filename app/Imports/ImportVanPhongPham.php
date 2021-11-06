<?php

namespace App\Imports;

use App\Models\VanPhongPham;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportVanPhongPham implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new VanPhongPham([
            'name' => $row[0],
            'dvt' => $row[1],
            'hanmuc_tb' => $row[2],
            'id_danhmuc' => $row[3],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
