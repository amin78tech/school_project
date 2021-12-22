<?php

namespace App\Models;

use App\Notifications\AddCourseStudent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CourseUser extends Model
{
    use HasFactory,Notifiable;
    protected $table='course_user';
}
