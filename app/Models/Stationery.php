<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stationery extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'unit'
        // 'id_category'
    ];

    protected $table = 'stationery';

    public function category()
    {
        // return $this->belongsTo(Category::class, 'id_category', 'id');
    }
}
