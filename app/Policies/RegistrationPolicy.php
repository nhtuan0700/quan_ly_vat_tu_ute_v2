<?php

namespace App\Policies;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistrationPolicy
{
    use HandlesAuthorization;

    public function handover(User $user, Registration $registration)
    {
        return is_null($registration->received_at) &&
            $registration->buy_note->id_department === $user->id_department;
    }
}
