<?php
namespace App\Repositories\DanhMuc;

use App\Models\DanhMuc;
use App\Repositories\BaseRepository;

class DanhMucRepository extends BaseRepository implements DanhMucInterface
{
    public function getModel()
    {
        return DanhMuc::class;
    }
}