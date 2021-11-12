<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietMua extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_phieu', 'id_vanphongpham', 'qty', 'cost'
    ];

    protected $table = 'chitietmua';
    public $incrementing = false;
    public $timestamps = false;

    public function vanphongpham()
    {
        return $this->belongsTo(VanPhongPham::class, 'id_vanphongpham', 'id');
    }
}
