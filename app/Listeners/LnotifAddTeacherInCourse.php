<?php

namespace App\Listeners;

use App\Events\notifAddTeacherInCourse;
use App\Notifications\AddCourseTeacher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LnotifAddTeacherInCourse
{
    public function __construct()
    {
        //
    }

    public function handle(notifAddTeacherInCourse $event)
    {
        $event->teacher_id->notify(new AddCourseTeacher());
    }
}
