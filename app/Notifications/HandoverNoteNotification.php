<?php

namespace App\Notifications;

use App\Models\HandoverNote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HandoverNoteNotification extends Notification implements ShouldQueue
{
    use Queueable;
    private $handover_note;
    private $request_note;

    public function __construct(HandoverNote $handover_note)
    {
        $this->handover_note = $handover_note;
        $this->request_note = $handover_note->request_note;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'id_handover_note' => $this->handover_note->id,
            'message' => $this->getMessage(),
            'path' => $this->getPath(),
        ];
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->getMessage(),
            'path' => $this->getPath(),
            'created_at' => format_datetime(now())
        ];
    }

    public function getMessage()
    {
        return sprintf('Phiếu %s có phiếu bàn giao mới', $this->request_note->id);
    }

    public function getPath()
    {
        $request_note = $this->request_note;
        if ($request_note->is_buy) {
            return getPathAfterDomain(route('buy_note.detail', ['id' => $request_note->id]));
        }
        return getPathAfterDomain(route('fix_note.detail', ['id' => $request_note->id]));
    }
}
