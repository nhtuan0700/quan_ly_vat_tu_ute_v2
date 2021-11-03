<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DotDangKy extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'start_at', 'end_at'
    ];
    protected $dates = ['end_at'];

    protected $table = 'dotdangky';
    public $incrementing = false;

    public function getStartAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i');
    }
    public function getEndAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i');
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function setStartAtAttribute($value)
    {
        $this->attributes['start_at'] = Carbon::createFromFormat('d/m/Y H:i', $value)->format('Y-m-d H:i');
    }

    public function setEndAtAttribute($value)
    {
        $this->attributes['end_at'] =  Carbon::createFromFormat('d/m/Y H:i', $value)->format('Y-m-d H:i');
    }

    // Ngoại trừ chưa diễn ra có thể sửa
    public function canEdit()
    {
        return Carbon::createFromFormat('d/m/Y H:i', $this->end_at)->gt(now());
    }

    // Chưa diễn ra mới có thể xóa
    public function canDelete()
    {
        return Carbon::createFromFormat('d/m/Y H:i', $this->start_at)->gt(now());
    }
}
