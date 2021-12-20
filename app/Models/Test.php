<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $table='tests';
    public function option()
    {
        return $this->hasOne(Option::class,'test_id','id');
    }
}
