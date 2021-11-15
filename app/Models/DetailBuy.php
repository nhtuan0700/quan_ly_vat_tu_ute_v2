<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBuy extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_note', 'id_stationery', 'qty', 'cost'
    ];

    protected $table = 'detail_buy';
    public $incrementing = false;
    public $timestamps = false;

    public function stationery()
    {
        return $this->belongsTo(Stationery::class, 'id_stationery', 'id');
    }
}
