<?php

namespace App\Notifications;

use App\Models\PeriodRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PeriodRegistrationNotification extends Notification implements ShouldQueue
{
    use Queueable;
    private $period;

    public function __construct(PeriodRegistration $period)
    {
        $this->period = $period;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'id_period' => $this->period->id,
            'message' => $this->getMessage(),
        ];
    }

    public function getMessage()
    {
        return sprintf(
            'Đợt đăng ký văn phòng phẩm vừa mới được tạo - Đợt %s',
            $this->period->id
        );
    }
}
