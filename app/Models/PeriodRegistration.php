<?php

namespace App\Models;

use App\Traits\TimestampFormatTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodRegistration extends Model
{
    use HasFactory, TimestampFormatTrait;
    protected $fillable = [
        'id', 'start_time', 'end_time'
    ];

    protected $table = 'period_registration';
    public $incrementing = false;

    public function getStartTimeAttribute($value)
    {
        return Carbon::parse($value)->format(app('datetime_format'));
    }
    public function getEndTimeAttribute($value)
    {
        return Carbon::parse($value)->format(app('datetime_format'));
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = Carbon::createFromFormat(app('datetime_format'), $value)->format('Y-m-d H:i');
    }
    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] =  Carbon::createFromFormat(app('datetime_format'), $value)->format('Y-m-d H:i');
    }

    public function buy_notes()
    {
        return $this->hasMany(RequestNote::class, 'id_period', 'id')->where('is_buy', true);
    }

    public function getBuyNoteDepartment()
    {
        $id_department = auth()->user()->id_department;
        return $this->buy_notes()->where('id_department', $id_department)->first();
    }

    public function myRegistrations()
    {
        return $this->hasMany(Registration::class, 'id_period', 'id')->where('id_user', auth()->id());
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'id_period', 'id');
    }

    public function getStatus()
    {
        // Đã diễn ra -> Đang diễn ra -> Chưa diễn ra
        // 0 -> 1 -> 2

        // Chưa diễn ra
        if ($this->getRawOriginal('start_time') > now()) {
            return 2;
        }
        // Đã diễn ra
        if ($this->getRawOriginal('end_time') < now()) {
            return 0;
        }
        // Đang diễn ra
        return 1;
    }

    public function getStatusHTMLAttribute()
    {
        $status = $this->getStatus();
        if ($status === 2) {
            return '<span class="badge badge-success">Sắp diễn ra</span>';
        }
        if ($status === 0) {
            return '<span class="badge badge-danger">Đã diễn ra</span>';
        }
        return '<span class="badge badge-info">Đang diễn ra</span>';
    }

    public function checkHandoverEnoughDepartment()
    {
        // Lấy phiếu của đơn vị tương ứng với đợt đăng ký
        $id_note = $this->buy_notes()
            ->where('id_department', auth()->user()->id_department)
            ->first()->id;
        // kiểm tra xem đã bàn giao hết hay chưa
        $status = $this->registrations()
            ->where('id_note', $id_note)
            ->whereNull('received_at')->count() === 0;
        return $status;
    }

    public function checkHandoverEnoughUser()
    {
        $status = $this->registrations()
            ->where('id_user', auth()->id())
            ->whereNull('received_at')->count() === 0;
        return $status;
    }
}
