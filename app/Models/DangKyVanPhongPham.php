<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangKyVanPhongPham extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'id_vanphongpham', 'id_dotdk', 'qty', 'received_at', 'id_phieu'
    ];

    protected $table = 'dangky_vanphongpham';
    protected $primaryKey = ['id_user', 'id_vanphongpham', 'id_dotdk'];
    public $incrementing = false;

}
