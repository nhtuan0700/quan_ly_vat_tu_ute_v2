<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LimitDefault extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_department', 'id_position', 'id_stationery', 'qty'
    ];

    protected $table = 'limit_default';
    public $incrementing = false;
}
