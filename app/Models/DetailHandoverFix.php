<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailHandoverFix extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_note', 'id_equipment'
    ];

    protected $table = 'detail_handover_fix';
    public $incrementing = false;
    public $timestamps = false;

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'id_equipment', 'id');
    }
}
