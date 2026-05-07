<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead($notificationId)
    {
        $notification = DatabaseNotification::findOrFail($notificationId);

        if ($notification->notifiable_id === Auth::user()?->id) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }
}
