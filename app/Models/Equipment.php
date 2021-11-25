<?php

namespace App\Models;

use App\Traits\TimestampFormatTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory, TimestampFormatTrait;
    public const NORMAL = 1;
    public const FIXING = 2;
    public const BROKEN = 3;

    protected $fillable = [
        'id', 'name', 'room', 'date_grant', 'date_buy', 'description', 'status'
    ];

    protected $appends = [
        'statusText'
    ];

    protected $attributes = [
        'status' => self::NORMAL
    ];

    protected $table = 'equipment';
    public $incrementing = false;

    public function getDateGrantAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format(app('date_format'));
        }
    }
    public function getDateBuyAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format(app('date_format'));
        }
    }

    public function setDateBuyAttribute($value)
    {
        if ($value) {
            $this->attributes['date_buy'] = Carbon::createFromFormat(app('date_format'), $value)->format('Y-m-d');
        }
    }
    public function setDateGrantAttribute($value)
    {
        if ($value) {
            $this->attributes['date_grant'] =  Carbon::createFromFormat(app('date_format'), $value)->format('Y-m-d');
        }
    }
    
    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case self::NORMAL:
                return 'Bình thường';
            case self::FIXING:
                return 'Chờ sửa';
            default:
                return 'Đã bị hư';
        }
    }
}
