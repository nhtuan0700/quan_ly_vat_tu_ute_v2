<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailHandoverBuy extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_note', 'id_stationery', 'qty'
    ];

    protected $table = 'detail_handover_buy';
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'qty' => 'integer',
    ];

    public function stationery()
    {
        return $this->belongsTo(Stationery::class, 'id_stationery', 'id');
    }
}
