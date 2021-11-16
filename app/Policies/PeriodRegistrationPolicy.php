<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PeriodRegistration;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class PeriodRegistrationPolicy
{
    use HandlesAuthorization;

    // Trừ đã diễn ra có thể sửa
    public function edit(User $user, PeriodRegistration $period)
    {
        return $user->can('period-manage') && Carbon::createFromFormat(app('datetime_format'), $period->end_time)->gt(now());
    }

    public function delete(User $user, PeriodRegistration $period)
    {
        return $user->can('period-manage') && Carbon::createFromFormat(app('datetime_format'), $period->start_time)->gt(now());
    }

    public function view_buy_note(User $user, PeriodRegistration $period)
    {
        return !!$period->getBuyNoteDepartment();
    }
}
