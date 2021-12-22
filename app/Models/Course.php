<?php

namespace App\Models;

use App\Notifications\AddCourseTeacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use phpDocumentor\Reflection\Types\This;

class Course extends Model
{
    use HasFactory,Notifiable;
    protected $table='courses';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function teacher()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
