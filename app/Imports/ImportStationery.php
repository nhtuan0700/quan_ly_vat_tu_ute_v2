<?php

namespace App\Imports;

use App\Models\Stationery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportStationery implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Stationery([
            'name' => $row[0],
            'unit' => $row[1],
            'limit_avg' => $row[2],
            'id_category' => $row[3],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
