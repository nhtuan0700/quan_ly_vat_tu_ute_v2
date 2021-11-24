<?php

namespace App\Models;

use App\Traits\TimestampFormatTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestNote extends Model
{
    use HasFactory, TimestampFormatTrait;
    public const PROCESSING = 1;
    public const CONFIRMED = 2;
    public const COMPLETED = 3;
    public const REJECTED = 4;

    protected $fillable = [
        'id', 'id_creator', 'id_handler', 'id_period', 'id_department', 'is_buy', 
        'status', 'processed_at', 'completed_at', 'description'
    ];

    protected $table = 'request_note';
    public $incrementing = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'id_creator', 'id');
    }

    public function handler()
    {
        return $this->belongsTo(User::class, 'id_handler', 'id');
    }

    public function detail_buy()
    {
        return $this->hasMany(DetailBuy::class, 'id_note', 'id')->with('stationery');
    }
    public function detail_fix()
    {
        return $this->hasMany(DetailFix::class, 'id_note', 'id')->with('equipment');
    }

    public function equipments()
    {
        return $this->belongsToMany(Equipment::class, 'detail_fix', 'id_note', 'id_equipment');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'id_department', 'id');
    }

    public function handover_notes()
    {
        return $this->hasMany(HandoverNote::class, 'id_request_note', 'id');
    }

    public function scopeBuy($query)
    {
        return $query->with('detail_buy')->where('is_buy', true);
    }

    public function scopeFix($query)
    {
        return $query->with('detail_fix')->where('is_buy', false);
    }

    public function getProcessedAtAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format(app('datetime_format'));
        }
    }

    public function getStatusHTMLAttribute()
    {
        switch ($this->status) {
            case self::PROCESSING:
                return '<span class="badge badge-info">Chờ xử lý</span>';
            case self::CONFIRMED:
                if ($this->is_buy) {
                    $qty_request = $this->detail_buy->sum('qty');
                    $qty_handovered = $this->detail_buy->sum('qty_handovered');
                } else {
                    $qty_request = $this->detail_fix->count();
                    $qty_handovered = $this->detail_fix()->where('is_handovered', true)->count();
                }
                return sprintf('<span class="badge badge-warning">Chờ bàn giao(%s/%s)</span>', $qty_handovered, $qty_request);
            case self::COMPLETED:
                return '<span class="badge badge-success">Đã hoàn thành</span>';
            case self::REJECTED:
                return '<span class="badge badge-danger">Bị từ chối</span>';
        }
    }

    public function getCategoryAttribute()
    {
        if ($this->is_buy) {
            return 'Phiếu Mua';
        }
        return 'Phiếu Sửa';
    }
}
