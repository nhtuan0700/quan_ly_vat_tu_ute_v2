<?php

namespace App\Notifications;

use App\Models\LimitStationery;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateLimitStationeryNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public function __construct()
    {
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Hạn mức văn phòng phẩm của bạn vừa được cập nhật',
            'path' => $this->getPath()
        ];
    }

    public function getPath()
    {
        return getPathAfterDomain(route('limit.index'));
    }
}
