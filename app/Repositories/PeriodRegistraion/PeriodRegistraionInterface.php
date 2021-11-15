<?php

namespace App\Repositories\PeriodRegistraion;

use App\Repositories\RepositoryInterface;

interface PeriodRegistraionInterface extends RepositoryInterface
{
    public function checkComing();
    public function getDotDangKyNow();

    public function getDotDangKyLast();

    /**
     * Load danh sách các đợt đăng ký (đang diễn ra, đã diễn ra)
     */
    public function list();
}
