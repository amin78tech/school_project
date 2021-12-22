<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function read($id)
    {
        $user=\auth()->user();
        foreach ($user->unreadNotifications as $notif){
            if ($notif['id']==$id){
                $notif->markAsRead();
            }
        }
        return back();
    }
}
