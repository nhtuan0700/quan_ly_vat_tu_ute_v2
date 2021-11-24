<?php

namespace App\Exceptions;

use Exception;

class UpdateDetailFixException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
