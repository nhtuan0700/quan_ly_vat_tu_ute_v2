<?php

namespace App\Notifications;

use App\Models\RequestNote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompleteRequestNoteNotification extends Notification implements ShouldQueue
{
    use Queueable;
    private $note;
    
    public function __construct(RequestNote $note)
    {
        $this->note = $note;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'id_note' => $this->note->id,
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
        return sprintf('Phiếu %s đã hoàn thành', $this->note->id);
    }

    public function getPath()
    {
        $note = $this->note;
        if ($note->is_buy) {
            return getPathAfterDomain(route('buy_note.detail', ['id' => $note->id]));
        }
        return getPathAfterDomain(route('fix_note.detail', ['id' => $note->id]));
    }
}
