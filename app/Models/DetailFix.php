<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFix extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_note', 'id_equipment', 'reason', 'cost'
    ];

    protected $table = 'detail_fix';
    public $incrementing = false;
    public $timestamps = false;

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'id_equipment', 'id');
    }
}
