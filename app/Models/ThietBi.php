<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThietBi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'phong', 'ngay_mua', 'ngay_cap', 'thong_so'
    ];

    protected $table = 'thietbi';
    public $incrementing = false;

    public function getNgayMuaAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('d/m/Y');
        }
    }
    public function getNgayCapAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('d/m/Y');
        }
    }

    public function setNgayMuaAttribute($value)
    {
        if ($value) {
            $this->attributes['ngay_mua'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        }
    }

    public function setNgayCapAttribute($value)
    {
        if ($value) {
            $this->attributes['ngay_cap'] =  Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        }
    }
}
