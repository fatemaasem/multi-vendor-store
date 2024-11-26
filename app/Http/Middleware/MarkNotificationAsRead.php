<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {  $user=$request->user();
     
         // Check if the user is authenticated
         if ($user) {
            // Retrieve the notification by ID from the request
            $notificationId = $request->query('notification_id');
            
            if ($notificationId) {
                // Find the notification in the authenticated user's notifications
                $notification = $user->notifications()->find($notificationId);

                if ($notification && $notification->unread()) {
                    // Mark the notification as read
                    $notification->markAsRead();
                }
            }
        }
        return $next($request);
    }
}
