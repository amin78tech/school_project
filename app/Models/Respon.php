<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respon extends Model
{
    use HasFactory;
    protected $table='respons';

    public function user()
    {
        return $this->belongsToMany(Startexam::class);
    }
}
