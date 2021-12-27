<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class UserLogoutController extends Controller
{
    public function logout()
    {
        $user_role=\auth()->user()->roles()->get();
        $get_role=$user_role[0]['name'];
         Auth::guard($get_role)->logout();
         session()->flush();
         return redirect()->route('UserLoginController.show');
    }
}
