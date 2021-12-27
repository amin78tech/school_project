<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Psy\Util\Str;
use function Doctrine\StaticAnalysis\DBAL\makeMeACustomConnection;

class UserAdminTableSeeder extends Seeder
{
    public function run()
    {
        User::query()->insert([
            'name'=>'muhammadamin',
            'family'=>'samadi',
            'username'=>'amin78tech',
            'email'=>'amin78tech@gmail.com',
            'password'=>Hash::make('9099101010'),
            'status'=>1,
            'created_at'=>now()
        ]);
        RoleUser::query()->insert([
           'user_id'=>1,
           'role_id'=>1
        ]);
    }
}
