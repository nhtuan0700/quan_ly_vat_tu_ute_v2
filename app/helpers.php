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
