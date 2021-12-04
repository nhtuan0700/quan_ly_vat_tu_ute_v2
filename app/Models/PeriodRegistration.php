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

    public function getStatusHTMLAttribute()
    {
        if ($this->getRawOriginal('start_time') > now()) {
            return '<span class="badge badge-success">Sắp diễn ra</span>';
        }
        if ($this->getRawOriginal('end_time') < now()) {
            return '<span class="badge badge-danger">Đã diễn ra</span>';
        }
        return '<span class="badge badge-info">Đang diễn ra</span>';
    }
}
