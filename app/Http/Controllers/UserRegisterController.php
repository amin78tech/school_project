<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
{
    public function create()
    {
        $title="Register Users";
        return view("register")->with("title",$title);
    }

    public function store(UserRegisterRequest $request)
    {
        $all_req = $request->validated();
        if ($all_req["option"] == "admin") {
            Admin::insert([
                "name" => $all_req["name"],
                "family" => $all_req["family"],
                "username" => $all_req["username"],
                "email" => $all_req["email"],
                "password" => $all_req["password"],
                "created_at" => now(),
            ]);
        } else{
            User::insert([
                "name" => $all_req["name"],
                "family" => $all_req["family"],
                "username" => $all_req["username"],
                "email" => $all_req["email"],
                "password" => $all_req["password"],
                "role"=>$all_req["option"],
                "created_at" => now(),
            ]);
        }
        return back();
    }
}
