<?php

namespace App\Policies;

use App\Models\LogLimit;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LogLimitPolicy
{
    use HandlesAuthorization;

    public function process(User $user, LogLimit $log)
    {
        return $user->can('limit-process') &&
            is_null($log->is_confirm);
    }
}
