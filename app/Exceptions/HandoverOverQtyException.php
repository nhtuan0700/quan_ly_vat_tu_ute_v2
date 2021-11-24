<?php

namespace App\Exceptions;

use Exception;

class HandoverOverQtyException extends Exception
{
    public function __construct()
    {
        parent::__construct("Số lượng bàn giao vượt quá số lượng yêu cầu");
    }
}
