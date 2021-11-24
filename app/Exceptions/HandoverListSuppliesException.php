<?php

namespace App\Exceptions;

use Exception;

class HandoverListSuppliesException extends Exception
{
    public function __construct()
    {
        parent::__construct("Danh sách bàn giao không hợp lệ!");
    }
}
