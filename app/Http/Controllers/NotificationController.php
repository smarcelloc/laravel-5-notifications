<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function Notifications(Request $request)
    {
        $notifications = $request->user()->unreadNotifications;
        return response()->json(compact('notifications'));
    }

    public function MarkAsRead(Request $request)
    {
        $notifications = $request->user()->notifications()->where('id', $request->id)->first();
        
        if ($notifications) {
            $notifications->markAsRead();
        }
    }
    
    
    public function MarkAllAsRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();
    }
}
