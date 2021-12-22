<?php

namespace App\Providers;

use App\Events\notifAddStudentInCourse;
use App\Events\notifAddTeacherInCourse;
use App\Listeners\LnotifAddStudentInCourse;
use App\Listeners\LnotifAddTeacherInCourse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        notifAddTeacherInCourse::class => [
            LnotifAddTeacherInCourse::class
        ],
        notifAddStudentInCourse::class => [
            LnotifAddStudentInCourse::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
