<?php

namespace App\Repositories\PeriodRegistration;

use App\Repositories\RepositoryInterface;

interface PeriodRegistrationInterface extends RepositoryInterface
{
    public function checkComing();
    public function getItemNow();

    /**
     * Load danh sách các đợt đăng ký (đang diễn ra, đã diễn ra)
     */
    public function list();
}
