<?php

namespace App\Imports;

use App\Models\Equipment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportEquipment implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Equipment([
            'id' => $row['0'],
            'name' => $row['1'],
            'room' => $row['2'],
            'date_buy' => transformDateExcel($row['3']),
            'date_grant' => transformDateExcel($row['4']),
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
