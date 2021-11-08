<?php

namespace App\Models;

use App\Traits\TimestampFormatTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThietBi extends Model
{
    use HasFactory, TimestampFormatTrait;

    protected $fillable = [
        'id', 'name', 'phong', 'ngay_mua', 'ngay_cap', 'thong_so'
    ];

    protected $table = 'thietbi';
    public $incrementing = false;

    public function getNgayMuaAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format(app('date_format'));
        }
    }
    public function getNgayCapAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format(app('date_format'));
        }
    }

    public function setNgayMuaAttribute($value)
    {
        if ($value) {
            $this->attributes['ngay_mua'] = Carbon::createFromFormat(app('date_format'), $value)->format('Y-m-d');
        }
    }
    public function setNgayCapAttribute($value)
    {
        if ($value) {
            $this->attributes['ngay_cap'] =  Carbon::createFromFormat(app('date_format'), $value)->format('Y-m-d');
        }
    }
}
