<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'id_stationery', 'id_period', 'qty', 'received_at', 'id_note'
    ];

    protected $table = 'registration';
    protected $primaryKey = ['id_user', 'id_stationery', 'id_period'];
    public $incrementing = false;


    public function buy_note()
    {
        return $this->belongsTo(RequestNote::class, 'id_note', 'id');
    }
}
