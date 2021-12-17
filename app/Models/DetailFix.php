<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFix extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_note', 'id_equipment', 'reason', 'cost', 'is_handovered', 'is_fixable'
    ];

    protected $table = 'detail_fix';
    public $incrementing = false;

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'id_equipment', 'id');
    }

    public function getStatusTextAttribute()
    {
        if (is_null($this->is_fixable)) {
            return 'Chờ sửa';
        }
        if ($this->is_fixable === 1) {
            return 'Sửa được';
        }
        return 'Không sửa được';
    }
}
