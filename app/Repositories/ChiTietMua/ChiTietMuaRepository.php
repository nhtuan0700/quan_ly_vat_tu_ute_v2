<?php
namespace App\Repositories\ChiTietMua;

use App\Models\ChiTietMua;
use App\Repositories\BaseRepository;

class ChiTietMuaRepository extends BaseRepository implements ChiTietMuaInterface
{
    public function getModel()
    {
        return ChiTietMua::class;
    }
}