<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends \Illuminate\Foundation\Auth\User
{
    use HasFactory;
    protected $table = 'role_user';
    public $timestamps = false;

}
