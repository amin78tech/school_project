<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends \Illuminate\Foundation\Auth\User
{
    use HasFactory;
    protected $fillable = ['id','name','family','username','email','password','option'];
    protected $table = 'users';

    public function roles()
    {
        //see where
        return $this->belongsToMany(Role::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
