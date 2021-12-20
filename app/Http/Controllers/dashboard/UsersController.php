<?php
namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Utils;

class UsersController extends Controller
{
    public function getUserGuard()
    {
        $user_login=Auth::user();
        $user_guard=$user_login->roles()->get();
        return $user_guard[0]['guard'];
    }
    public function index()
    {
        $role_teacher=Role::query()->where('name', 'teacher')->first();
        $role_student=Role::query()->where('name', 'student')->first();
        $final=array_merge($role_teacher->users()->get()->toArray(),$role_student->users()->get()->toArray());
        $title='User List Page';
        return view('dashboard.users.userlist')
            ->with('title',$title)
            ->with('users',$final)
            ->with('guard',$this->getUserGuard());
    }
    public function show(Request $request)
    {
        if ($request['name']!==null or $request['family']!==null or $request['username']!==null) {
            $get=User::query()->where("name",$request['name'])
                ->orWhere('family',$request['family'])
                ->orWhere('username',$request['username']);
            $data=$get->get();
            if ($data->count()!==0){
                $get_role=$get->first()->roles()->get();
            return view('dashboard.users.userlist')
                ->with('title','User Search Page')
                ->with('searchUser',$data)
                ->with('role',$get_role)
                ->with('guard',$this->getUserGuard());
            }else{
                return view('dashboard.users.userlist')
                    ->with('title','User Search Page')
                    ->with('searchUser',$data)
                    ->with('guard',$this->getUserGuard());
            }
        }elseif ($request['option']!=='select role user'){
            if ($request['option']=='teacher'){
                $get=Role::query()->where('name','teacher')->first();
                $data=$get->users()->get();
                return view('dashboard.users.userlist')
                    ->with('title','User Search Page')
                    ->with('searchUser',$data)
                    ->with('guard',$this->getUserGuard());
            }else{
                $get=Role::query()->where('name','student')->first();
                $data=$get->users()->get();
                return view('dashboard.users.userlist')
                    ->with('title','User Search Page')
                    ->with('searchUser',$data)
                    ->with('guard',$this->getUserGuard());
            }
        }elseif ($request['status']!=='select status account'){
            if ($request['status']=='1'){
                $get=User::query()->where('status',1)->get();
                if ($get->count()!==0){
                    $get_role=$get->first()->roles()->get();
                    return view('dashboard.users.userlist')
                        ->with('title','User Search Page')
                        ->with('searchUser',$get)
                        ->with('role',$get_role)
                        ->with('guard',$this->getUserGuard());
                }else{
                    return view('dashboard.users.userlist')
                        ->with('title','User Search Page')
                        ->with('searchUser',$get)
                        ->with('guard',$this->getUserGuard());
                }
            }else{
                $get=User::query()->where('status',0)->get();
                if ($get->count()!==0){
                    $get_role=$get->first()->roles()->get();
                    return view('dashboard.users.userlist')
                        ->with('title','User Search Page')
                        ->with('searchUser',$get)
                        ->with('role',$get_role)
                        ->with('guard',$this->getUserGuard());
                }else{
                    return view('dashboard.users.userlist')
                        ->with('title','User Search Page')
                        ->with('searchUser',$get)
                        ->with('guard',$this->getUserGuard());
                }
                }
        } else{
            $get=User::query()->where("name",null);
            $data=$get->get();
            return view("dashboard.users.userlist")
                ->with("title","User Search Page")
                ->with("searchUser",$data)
                ->with('guard',$this->getUserGuard());
        }
    }
    public function edit($id)
    {
        $get=User::findOrFail($id);
        $get_role=$get->roles()->get();
        return view("dashboard.users.useredit")
            ->with("title","Student Update Page")
            ->with("id",$get["id"])
            ->with("name",$get["name"])
            ->with("family",$get["family"])
            ->with("username",$get["username"])
            ->with("email",$get["email"])
            ->with("password",'New Password')
            ->with("role",$get_role)
            ->with('guard',$this->getUserGuard());
    }
    public function update(UserUpdateRequest $request, $id)
    {
        $get_all=$request->validated();
        if ($request['password']==null){
            User::where('id', $id)
            ->update([
                "name"=>$get_all["name"],
                "family"=>$get_all["family"],
                "username"=>$get_all["username"],
                "email"=>$get_all["email"],
                'updated_at'=>now(),
            ]);
            RoleUser::query()->where('user_id',$id)->update([
               'role_id'=> intval($get_all['option']),
            ]);
        }else{
            User::where('id', $id)
            ->update([
                "name"=>$get_all["name"],
                "family"=>$get_all["family"],
                "username"=>$get_all["username"],
                "email"=>$get_all["email"],
                "password"=>Hash::make($get_all["password"]),
                'updated_at'=>now()
            ]);
            RoleUser::query()->where('user_id',$id)->update([
                'role_id'=> intval($get_all['option']),
            ]);
        }
        return redirect()->route("UserController.index");
    }
    public function destroy($id)
    {
        User::destroy($id);
        RoleUser::query()->where('user_id',$id)->delete();
        return redirect()->route("UserController.index");
    }

    public function updateStatus(Request $request,$id)
    {
        $get_req=$request["status"];
        if ($get_req=="inactive"){
            $get=User::findOrFail($id);
            $get->status=1;
            $get->save();
        }else{
            $get=User::findorFail($id);
            $get=User::findOrFail($id);
            $get->status=0;
            $get->save();
        }
        return redirect()->route("UserController.index");
    }
}
