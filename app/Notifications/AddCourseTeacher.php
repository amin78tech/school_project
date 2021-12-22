<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddCourseTeacher extends Notification
{
    use Queueable;
    public function __construct()
    {

    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase()
    {
        return [
            'notice'=>':شما به یک دوره اضافه شدید',
        ];
    }
}
