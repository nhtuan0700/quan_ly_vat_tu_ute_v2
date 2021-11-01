<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VanPhongPham extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'dvt', 'hanmuc_tb', 'id_danhmuc'
    ];

    protected $table = 'vanphongpham';

    public function danhmuc()
    {
        return $this->belongsTo(DanhMuc::class, 'id_danhmuc', 'id');
    }
}
