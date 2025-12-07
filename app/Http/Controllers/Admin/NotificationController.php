<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get unread notifications for the admin user
        $notifications = $user->unreadNotifications()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->map(function ($notification) {
                $data = $notification->data;
                return [
                    'id' => $notification->id,
                    'title' => $this->getNotificationTitle($data['type'] ?? ''),
                    'message' => $data['message'] ?? 'No message',
                    'created_at' => $notification->created_at->diffForHumans(),
                    'type' => $data['type'] ?? 'unknown',
                    'data' => $data  // Include all data for JavaScript access
                ];
            });

        return response()->json($notifications);
    }

    private function getNotificationTitle($type)
    {
        switch ($type) {
            case 'NewApplicationSubmitted':
                return 'New Application Submitted';
            case 'sa_request_created':
                return 'New SA Request';
            case 'join_request_accepted':
                return 'Join Request Accepted';
            case 'join_request_rejected':
                return 'Join Request Rejected';
            default:
                return 'Notification';
        }
    }

    public function markAsRead(Request $request, $notificationId)
    {
        $user = auth()->user();
        $notification = $user->notifications()->where('id', $notificationId)->first();
        
        if ($notification) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 404);
    }

    public function markAllAsRead()
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        
        return response()->json(['success' => true]);
    }
}
