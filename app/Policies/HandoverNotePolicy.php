<?php

namespace App\Policies;

use App\Models\HandoverNote;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HandoverNotePolicy
{
    use HandlesAuthorization;

    public function confirm(User $user, HandoverNote $note)
    {
        return $user->can('handover_note-manage') &&
            !$note->confirmed_at;
    }

    public function update(User $user, HandoverNote $note)
    {
        return $user->can('handover_note-manage') &&
            !$note->confirmed_at;
    }

    public function delete(User $user, HandoverNote $note)
    {
        return $user->can('handover_note-manage') &&
            !$note->confirmed_at;
    }
}
