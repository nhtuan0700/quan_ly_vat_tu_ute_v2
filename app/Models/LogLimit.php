<?php

namespace App\Models;

use App\Traits\TimestampFormatTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogLimit extends Model
{
    use HasFactory, TimestampFormatTrait;
    protected $fillable = [
        'id_updater', 'id_confirmer', 'file', 'data', 'is_confirm', 'processed_at', 'files'
    ];

    protected $table = 'log_limit';

    public function updater()
    {
        return $this->belongsTo(User::class, 'id_updater', 'id');
    }

    public function confirmer()
    {
        return $this->belongsTo(User::class, 'id_confirmer', 'id');
    }

    public function getFilesAttribute($value)
    {
        if (!is_null($value)) {
            $array = array_map(function ($item) {
                return asset('storage/' . $item);
            }, json_decode($value));
        } else {
            $array = [];
        }
        return $array;
    }

    public function setFilesAttribute($value)
    {
        return $this->attributes['files'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getStatusHTMLAttribute()
    {
        if (is_null($this->is_confirm)) {
            return '<span class="badge badge-warning">Chờ xử lý</span>';
        }
        if ($this->is_confirm) {
            return '<span class="badge badge-success">Đã duyệt</span>';
        }
        return '<span class="badge badge-danger">Từ chối</span>';
    }

    public function getFileAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
