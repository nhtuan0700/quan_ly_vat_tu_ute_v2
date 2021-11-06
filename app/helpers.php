<?php
if (!function_exists('transformDateExcel')) {
    function transformDateExcel($value)
    {
        try {
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format(app('date_format'));
        } catch (\Throwable $th) {
            return $value;
        }
    }
}

if (!function_exists('quy_in_year')) {
    function quy_in_year()
    {
        $month = now()->month;
        if ($month >= 1 && $month <=4) {
            return 1;
        }
        if ($month >= 5 && $month <=8) {
            return 2;
        }
        if ($month >= 9 && $month <=12) {
            return 3;
        }
    }
}
