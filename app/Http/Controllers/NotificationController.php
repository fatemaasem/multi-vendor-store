<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index(){

    }

    public function show($notification){
    $notification = DatabaseNotification::find($notification);
         // Mark as read
        
    $notification->markAsRead();

        return view('notification.show',['notification'=>$notification]);
    }
}
