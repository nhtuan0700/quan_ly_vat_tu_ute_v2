<?php

namespace App\Models;

use App\Traits\TimestampFormatTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DotDangKy extends Model
{
    use HasFactory, TimestampFormatTrait;
    protected $fillable = [
        'id', 'start_at', 'end_at'
    ];
    // protected $dates = ['end_at'];

    protected $table = 'dotdangky';
    public $incrementing = false;

    public function getStartAtAttribute($value)
    {
        return Carbon::parse($value)->format(app('datetime_format'));
    }
    public function getEndAtAttribute($value)
    {
        return Carbon::parse($value)->format(app('datetime_format'));
    }

    public function setStartAtAttribute($value)
    {
        $this->attributes['start_at'] = Carbon::createFromFormat(app('datetime_format'), $value)->format('Y-m-d H:i');
    }
    public function setEndAtAttribute($value)
    {
        $this->attributes['end_at'] =  Carbon::createFromFormat(app('datetime_format'), $value)->format('Y-m-d H:i');
    }

    // Ngoại trừ chưa diễn ra có thể sửa
    public function canEdit()
    {
        return Carbon::createFromFormat(app('datetime_format'), $this->end_at)->gt(now());
    }

    // Chưa diễn ra mới có thể xóa
    public function canDelete()
    {
        return Carbon::createFromFormat(app('datetime_format'), $this->start_at)->gt(now());
    }

    public function phieumua()
    {
        return $this->hasOne(PhieuDeNghi::class, 'id_dotdk', 'id')->where('is_mua', true);
    }
}
