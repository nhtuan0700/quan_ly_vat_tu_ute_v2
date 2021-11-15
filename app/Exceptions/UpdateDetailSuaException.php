<?php

namespace App\Exceptions;

use Exception;

class UpdateDetailSuaException extends Exception
{
    public function __construct()
    {
        parent::__construct("Thiết bị sửa được thì chi phí không được để trống");
    }
}
