<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\CourseUser;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\returnArgument;

class UserRegisterController extends Controller
{
    public function create()
    {
        $title='Register Users';
        $roles=Role::query()->get();
        $num=0;
        return view("register")
            ->with('title',$title)
            ->with('roles',$roles)
            ->with('num',$num);
    }
    public function store(UserRegisterRequest $request)
    {
        if ($request['option']!=='admin'){
            $all_req = $request->validated();
            $user=new User();
            $user->name=$all_req['name'];
            $user->family=$all_req['family'];
            $user->username=$all_req['username'];
            $user->email=$all_req['email'];
            $user->password=Hash::make($all_req['password']);
            $user->save();
            RoleUser::query()->insert([
                'user_id' => $user->id,
                'role_id' => intval($all_req['option'])
            ]);
        return redirect()->route('UserLoginController.show');
        }
    }
}
