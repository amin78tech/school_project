<?php

namespace App\Events;

use App\Models\Course;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class notifAddTeacherInCourse
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $teacher_id;
    public function __construct($id)
    {
        $this->teacher_id=User::query()->where('id',$id)->first();
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
