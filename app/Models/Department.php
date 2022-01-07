<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'department';

    public $incrementing = false;

    public function notes()
    {
        return $this->hasMany(RequestNote::class, 'id_department');
    }

    public function positions() {
        return Position::where('is_room', $this->is_room)->get();
    }
}
