<?php
namespace App\Repositories\DonVi;

use App\Models\DonVi;
use App\Repositories\BaseRepository;

class DonViRepository extends BaseRepository implements DonViInterface
{
    public function getModel()
    {
        return DonVi::class;
    }
}