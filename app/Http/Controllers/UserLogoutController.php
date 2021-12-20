<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLogoutController extends Controller
{
    public function logout()
    {
         Auth::guard('admin')->logout();
         return redirect()->route('UserLoginController.show');
    }
}
