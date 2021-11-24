<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Traits\TimestampFormatTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HandoverNote extends Model
{
    use HasFactory, TimestampFormatTrait;

    protected $fillable = [
        'id', 'id_creator', 'id_request_note', 'confirmed_at'
    ];

    protected $table = 'handover_note';
    public $incrementing = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'id_creator', 'id');
    }

    public function request_note()
    {
        return $this->belongsTo(RequestNote::class, 'id_request_note', 'id');
    }

    public function detail_handover_buy()
    {
        return $this->hasMany(DetailHandoverBuy::class, 'id_note', 'id');
    }

    public function detail_handover_fix()
    {
        return $this->hasMany(DetailHandoverFix::class, 'id_note', 'id');
    }

    public function detail_handover_buy2($is_edit = false)
    {
        $stationeries_buy = DB::table('stationery')
            ->join('detail_buy', 'stationery.id', '=', 'detail_buy.id_stationery')
            ->where('detail_buy.id_note', $this->id_request_note)
            ->select('id_stationery', 'name', 'unit', 'cost', 'detail_buy.qty', 'qty_handovered');

        $stationeries_handover = DB::table('detail_handover_buy')
            ->rightJoinSub($stationeries_buy, 'stationeries_buy', function ($join) {
                $join->on('stationeries_buy.id_stationery', '=', 'detail_handover_buy.id_stationery');
            })
            ->where('detail_handover_buy.id_note', $this->id)
            ->select('*')
            ->addSelect('detail_handover_buy.qty as qty_handovering')
            ->get();
        if ($is_edit) {
            return $stationeries_handover->concat($stationeries_buy->get()
                ->whereNotIn('id_stationery', $stationeries_handover->pluck('id_stationery')));
        }
        return $stationeries_handover;
    }

    public function detail_handover_fix2($is_edit = false)
    {
        $equipments_fix = DB::table('equipment')
            ->join('detail_fix', 'equipment.id', '=', 'detail_fix.id_equipment')
            ->where('detail_fix.id_note', $this->id_request_note)
            ->select(
                'id_equipment',
                'name',
                'room',
                'detail_fix.cost',
                'detail_fix.reason',
                'detail_fix.is_handovered',
                'detail_fix.is_fixable',
                'equipment.status',
            );

        $equipments_handover = DB::table('detail_handover_fix')
            ->rightJoinSub($equipments_fix, 'equipments_fix', function ($join) {
                $join->on('equipments_fix.id_equipment', '=', 'detail_handover_fix.id_equipment');
            })
            ->where('detail_handover_fix.id_note', $this->id)
            ->select('*')
            ->get();
        if ($is_edit) {
            return $equipments_handover->concat($equipments_fix->get()
                ->whereNotIn('id_equipment', $equipments_handover->pluck('id_equipment')));
        }
        return $equipments_handover;
    }

    public function getStatusTextAttribute()
    {
        return !$this->confirmed_at ? 'Chờ xác nhận' : 'Đã xác nhận';
    }
}
