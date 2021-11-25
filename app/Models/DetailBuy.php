<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailBuy extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_note', 'id_stationery', 'qty', 'cost', 'qty_handovered'
    ];

    protected $table = 'detail_buy';
    public $incrementing = false;
    public $timestamps = false;

    public function stationery()
    {
        return $this->belongsTo(Stationery::class, 'id_stationery', 'id')->withTrashed();
    }

    public function note()
    {
        return $this->belongsTo(RequestNote::class, 'id_note', 'id');
    }

    public function qtyHandOvering($id_handover_note)
    {
        $query = DB::table('detail_handover_buy')
            ->join('handover_note', 'handover_note.id', '=', 'detail_handover_buy.id_note')
            ->where('detail_handover_buy.id_stationery', '=', $this->id_stationery)
            ->where('handover_note.id_request_note', '=', $this->id_note)
            ->whereNull('handover_note.confirmed_at')
            ->select('detail_handover_buy.qty')
            ->first();

        return $query ? $query->qty : 0;
    }
}
