<?php

use App\Models\RequestNote;

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

if (!function_exists('quarter_of_year')) {
    function quarter_of_year()
    {
        $month = now()->month;
        if ($month >= 1 && $month <= 4) {
            return 1;
        }
        if ($month >= 5 && $month <= 8) {
            return 2;
        }
        if ($month >= 9 && $month <= 12) {
            return 3;
        }
    }
}

if (!function_exists('format_currency')) {
    function format_currency($currency)
    {
        if ($currency) {
            return number_format($currency) . " đ";
        }
        return '';
    }
}

if (!function_exists('count_note_processing')) {
    function count_note_processing()
    {
        $count = app(RequestNote::class)->where('status', RequestNote::PROCESSING)->count();
        return $count;
    }
}

if (!function_exists('format_datetime')) {
    function format_datetime($datetime)
    {
        if ($datetime) {
            return \Carbon\Carbon::parse($datetime)->format(app('datetime_format'));
        }
        return '';
    }
}

if (!function_exists('generateRandomStringNumber')) {
    function generateRandomStringNumber($length = 8)
    {
        $characters = '0123456789';
        $stringResult = '';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $stringResult .= $characters[rand(0, $charactersLength - 1)];
        }
        return $stringResult;
    }
}

if (!function_exists('getPathAfterDomain')) {
    function getPathAfterDomain($path)
    {
        return parse_url($path)['path'];
    }
}
