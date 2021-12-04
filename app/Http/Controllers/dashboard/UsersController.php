<?php
namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Utils;

class UsersController extends Controller
{
    public function index()
    {
        $users=User::all();
        $title="User List Page";
        return view("dashboard.users.userlist")
            ->with("title",$title)
            ->with("users",$users);
    }
    public function show(Request $request)
    {
        if ($request['name']!==null or $request['family']!==null or $request['username']!==null) {
            $get=User::query()->where("name",$request['name'])
                ->orWhere("family",$request['family'])
                ->orWhere("username",$request['username']);
            $data=$get->get();
            return view("dashboard.users.userlist")
                ->with("title","User Search Page")
                ->with("searchUser",$data);
        }elseif ($request['option']!=="select role user"){
            $get=User::query()->where("role",$request['option']);
            $data=$get->get();
            return view("dashboard.users.userlist")
                ->with("title","User Search Page")
                ->with("searchUser",$data);
        }elseif ($request['status']!=="select status account"){
            $get=User::query()->where("status",$request['status']);
            $data=$get->get();
            return view("dashboard.users.userlist")
                ->with("title","User Search Page")
                ->with("searchUser",$data);
        } else{
            $get=User::query()->where("name",null);
            $data=$get->get();
            return view("dashboard.users.userlist")
                ->with("title","User Search Page")
                ->with("searchUser",$data);
        }
    }

    public function edit($id)
    {
        $get=User::findOrFail($id);
        return view("dashboard.users.useredit")
            ->with("title","Student Update Page")
            ->with("id",$get["id"])
            ->with("name",$get["name"])
            ->with("family",$get["family"])
            ->with("username",$get["username"])
            ->with("email",$get["email"])
            ->with("password",$get["password"])
            ->with("role",$get["role"]);
    }
    public function update(UserUpdateRequest $request, $id)
    {
        $get_all=$request->validated();
        User::where('id', $id)
            ->update([
                "name"=>$get_all["name"],
                "family"=>$get_all["family"],
                "username"=>$get_all["username"],
                "email"=>$get_all["email"],
                "password"=>$get_all["password"],
                "role"=>$get_all["option"]
            ]);
        return redirect()->route("UserController.index");
    }
    public function destroy($id)
    {
        User::destroy($id);
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
