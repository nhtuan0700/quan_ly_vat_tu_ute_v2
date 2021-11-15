<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationeryLimit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'id_stationery', 'qty_used', 'qty_max', 'quarter_year', 'year'
    ];

    protected $table = 'stationery_limit';
    protected $primaryKey = ['id_user', 'id_stationery'];
    public $incrementing = false;

    public function stationery()
    {
        return $this->belongsTo(Stationery::class, 'id_stationery', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
