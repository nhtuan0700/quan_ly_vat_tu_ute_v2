<?php

namespace App\Exceptions;

use Exception;

class StoreFixEquipmentException extends Exception
{
    public function __construct()
    {
        parent::__construct("Thiết bị yêu cầu sửa không hợp lệ!");
    }
}
