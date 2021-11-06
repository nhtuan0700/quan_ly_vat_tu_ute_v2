<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HanMuc extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'id_vanphongpham', 'qty_used', 'qty_max', 'quy', 'year'
    ];

    protected $table = 'hanmuc';
    protected $primaryKey = ['id_user', 'id_vanphongpham'];
    public $incrementing = false;

    public function vanphongpham()
    {
        return $this->belongsTo(VanPhongPham::class, 'id_vanphongpham', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
