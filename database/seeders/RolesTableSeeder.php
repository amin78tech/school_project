<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        Role::query()->insert([
            'name' =>'admin',
            'guard' =>'admin',
            'created_at'=> now()
        ]);
        Role::query()->insert([
            'name' =>'teacher',
            'guard' =>'teacher',
            'created_at'=> now()
        ]);
        Role::query()->insert([
            'name' =>'student',
            'guard' =>'student',
            'created_at'=> now()
        ]);
    }
}
