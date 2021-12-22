<?php

namespace App\Listeners;

use App\Events\notifAddStudentInCourse;
use App\Notifications\AddCourseStudent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LnotifAddStudentInCourse
{
    public function __construct()
    {
        //
    }
    public function handle(notifAddStudentInCourse $event)
    {
        $event->user_id->notify(new AddCourseStudent());
    }
}
