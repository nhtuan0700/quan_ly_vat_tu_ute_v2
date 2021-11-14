<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietSua extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_phieu', 'id_thietbi', 'reason', 'cost'
    ];

    protected $table = 'chitietsua';
    public $incrementing = false;
    public $timestamps = false;

    public function thietbi()
    {
        return $this->belongsTo(ThietBi::class, 'id_thietbi', 'id');
    }
}
