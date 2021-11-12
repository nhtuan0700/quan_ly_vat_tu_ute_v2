<?php
namespace App\Repositories\PhieuDeNghi;

use App\Repositories\RepositoryInterface;

interface PhieuDeNghiInterface extends RepositoryInterface
{
    public const CONFIRMING = 1;
    public const CONFIRMED = 2;
    public const FINISH = 3;

    public function listPhieuMuaDonVi($id_donvi);
    public function create_mua($attributes = []);
    public function find_mua($id);
    public function create_sua($attributes = []);
}