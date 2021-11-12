<?php

namespace App\Repositories\DotDangKy;

use App\Repositories\RepositoryInterface;

interface DotDangKyInterface extends RepositoryInterface
{
    public function checkComing();
    public function getDotDangKyNow();

    public function getDotDangKyLast();

    /**
     * Load danh sách các đợt đăng ký (đang diễn ra, đã diễn ra)
     */
    public function list();
}
