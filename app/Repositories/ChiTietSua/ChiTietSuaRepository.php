<?php
namespace App\Repositories\ChiTietSua;

use App\Models\ChiTietSua;
use App\Repositories\BaseRepository;

class ChiTietSuaRepository extends BaseRepository implements ChiTietSuaInterface
{
    public function getModel()
    {
        return ChiTietSua::class;
    }
}