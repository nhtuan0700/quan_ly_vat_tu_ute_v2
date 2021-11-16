<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Models\RequestNote;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestNotePolicy
{
    use HandlesAuthorization;

    public function view_buy(User $user, RequestNote $note)
    {
        return $user->id_donvi === $note->id_donvi;
    }

    public function view_fix(User $user, RequestNote $note)
    {
        return $user->id === $note->id_creator;
    }

    public function update_fix(User $user, RequestNote $note)
    {
        return $user->id === $note->id_creator &&
            $note->status == RequestNote::PROCESSING &&
            !$note->is_buy;
    }

    public function delete_fix(User $user, RequestNote $note)
    {
        return $user->id === $note->id_creator &&
            $note->status == RequestNote::PROCESSING &&
            !$note->is_buy;
    }

    public function confirm(User $user, RequestNote $note)
    {
        return $note->status == RequestNote::PROCESSING &&
            $user->id_role == Role::HANDLER;
    }
    
    public function reject(User $user, RequestNote $note)
    {
        return $note->status == RequestNote::PROCESSING &&
            $note->is_buy == false &&
            $user->id_role == Role::HANDLER ;
    }

    public function update_detail_fix(User $user, RequestNote $note)
    {
        return $note->status == RequestNote::CONFIRMED &&
            $user->id_role == Role::HANDLER;
    }
}
