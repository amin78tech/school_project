<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use phpDocumentor\Reflection\DocBlock\Tags\Version;
use Ramsey\Collection\AbstractArray;

class UserLoginController extends Controller
{
    public function show()
    {
        if (\auth()->guard('admin')->check()) {
            return redirect()->route('UserController.index');
        } elseif (\auth()->guard('teacher')->check()) {
            return redirect()->route('OverviewController.show');
        } elseif (\auth()->guard('student')->check()) {
            return redirect()->route('OverviewController.show');
        } else {
            $title = "Login page";
            return view("login")
                ->with("title", $title);
        }
    }

    public function store(UserLoginRequest $request)
    {
        $get_data = $request->validated();
        if ($get_data['option'] == 'admin') {
            if (Auth::guard('admin')->attempt(['email' => $get_data['email'], 'password' => $get_data['password']])) {
                return redirect()->route('OverviewController.show');
            } else {
                $title = 'Login page';
                return \view('login')
                    ->with('title', $title)
                    ->with('login_error', "نام کاربری یا پسورد اشتباه می باشد");
            }
        } elseif ($get_data['option'] == 'teacher') {
            if (Auth::guard('teacher')->attempt(['email' => $get_data['email'], 'password' => $get_data['password']])) {
                $get_email = $request->email;
                $get_status = User::query()->select('status')->where('email', $get_email)->get();
                if ($get_status[0]['status'] == 0) {
                    $title = 'Login page';
                    return \view('login')
                        ->with('title', $title)
                        ->with('status_error', "اکانت شما غیر فعال می باشد");
                } else {
                    return redirect()->route('OverviewController.show');
                }
            }
            } elseif ($get_data['option'] == 'student') {
                if (Auth::guard('student')->attempt(['email' => $get_data['email'], 'password' => $get_data['password']])) {
                    $get_email = $request->email;
                    $get_status = User::query()->select('status')->where('email', $get_email)->get();
                    if ($get_status[0]['status'] == 0) {
                        $title = 'Login page';
                        return \view('login')
                            ->with('title', $title)
                            ->with('status_error', "اکانت شما غیر فعال می باشد");
                    } else {
                        return redirect()->route('OverviewController.show');
                    }
                }else {
                    $title = 'Login page';
                    return \view('login')
                        ->with('title', $title)
                        ->with('login_error', "نام کاربری یا پسورد اشتباه می باشد");
                }
            }
        }
    }
