<?php

namespace App\Imports;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportUser implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'id' => $row['0'],
            'name' => $row['1'],
            'email' => $row['2'],
            'password' => Hash::make($row['3']),
            'tel' => $row['4'],
            'dob' => transformDateExcel($row['5']),
            'cmnd' => $row['6'],
            'id_role' => $row['7'],
            'id_donvi' => $row['8'],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
