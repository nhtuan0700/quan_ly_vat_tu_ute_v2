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
        return $user->can('request_note-process') && $note->status == RequestNote::PROCESSING;
    }

    public function reject(User $user, RequestNote $note)
    {
        return $user->can('request_note-process') &&
            $note->status == RequestNote::PROCESSING &&
            $note->is_buy == false;
    }

    public function update_detail_fix(User $user, RequestNote $note)
    {
        return $user->can('request_note-process') &&
            $note->status == RequestNote::CONFIRMED;
    }

    public function create_handover(User $user, RequestNote $note)
    {
        $can = $user->can('handover_note-manage') &&
            $note->status == RequestNote::CONFIRMED &&
            (!$note->handover_notes()->whereNull('confirmed_at')->exists());
        if ($note->is_buy) {
            return $can;
        } else {
            return $can && $note->detail_fix->whereNotNull('is_fixable')->where('is_handovered', false)->isNotEmpty();
        }
    }

    public function view_handover(User $user, RequestNote $note)
    {
        return $note->status == RequestNote::CONFIRMED ||
            $note->status == RequestNote::COMPLETED;
    }
}
