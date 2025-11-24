<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityGroupJoinRequest;
use App\Models\CommunityGroup;
use Illuminate\Support\Facades\Auth;

class CommunityGroupJoinRequestController extends Controller
{
    // Student requests to join a group
    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required|integer|exists:community_groups,id',
        ]);
        $userId = Auth::id();
        $groupId = $request->group_id;
        // Only create if not already requested or member
        $alreadyRequested = CommunityGroupJoinRequest::where('community_group_id', $groupId)
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->exists();
        $alreadyMember = CommunityGroup::find($groupId)?->members()->where('users.id', $userId)->exists();
        if ($alreadyRequested || $alreadyMember) {
            return response()->json(['success' => false, 'message' => 'Already requested or member.']);
        }
        CommunityGroupJoinRequest::create([
            'community_group_id' => $groupId,
            'user_id' => $userId,
            'status' => 'pending',
        ]);
        return response()->json(['success' => true]);
    }

    // Owner views pending requests
    public function index(Request $request)
    {
        $ownerId = Auth::id();
        $groups = CommunityGroup::where('owner_id', $ownerId)->pluck('id');
        $requests = CommunityGroupJoinRequest::with('user')
            ->whereIn('community_group_id', $groups)
            ->where('status', 'pending')
            ->get();
        return response()->json($requests);
    }

    // Owner accepts or rejects
    public function update(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:accept,reject',
        ]);
        $joinRequest = CommunityGroupJoinRequest::findOrFail($id);
        $group = CommunityGroup::find($joinRequest->community_group_id);
        if (!$group || $group->owner_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.']);
        }
        if ($joinRequest->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Already processed.']);
        }
        if ($request->action === 'accept') {
            $joinRequest->status = 'accepted';
            $joinRequest->save();
            // Add user to group
            $group->members()->syncWithoutDetaching([$joinRequest->user_id]);
            $acceptedUserName = $joinRequest->user->name;
            // Message for everyone: joined the group
            $joinMsg = $acceptedUserName . ' joined the group.';
            $joinMessage = \App\Models\GroupMessage::create([
                'community_group_id' => $group->id,
                'user_id' => $joinRequest->user_id,
                'message' => $joinMsg,
            ]);
            broadcast(new \App\Events\GroupMessageSent($group->id, $joinRequest->user->only(['id','name','username','profile_photo']), $joinMsg))->toOthers();
            
            // Notify the user that their request was accepted
            \Log::info('Sending acceptance notification to user: ' . $joinRequest->user_id . ' for group: ' . $group->name);
            $joinRequest->user->notify(new \App\Notifications\JoinRequestAccepted($group->name));
        } else {
            $joinRequest->status = 'rejected';
            $joinRequest->save();
            // Notify the user that their request was rejected
            \Log::info('Sending rejection notification to user: ' . $joinRequest->user_id . ' for group: ' . $group->name);
            $joinRequest->user->notify(new \App\Notifications\JoinRequestRejected($group->name));
        }
        return response()->json(['success' => true]);
    }

    // Get community join request notifications for current user
    public function getUserNotifications(Request $request)
    {
        $userId = Auth::id();
        
        // Get user's notifications related to community join requests (last 30 days for testing)
        $notifications = auth()->user()->notifications()
            ->where(function($query) {
                $query->where('type', 'LIKE', '%JoinRequestAccepted%')
                      ->orWhere('type', 'LIKE', '%JoinRequestRejected%');
            })
            ->where('created_at', '>=', now()->subDays(30))
            ->orderBy('created_at', 'desc')
            ->get();
        
        \Log::info('User ' . $userId . ' has ' . $notifications->count() . ' community notifications');
        
        return response()->json($notifications->map(function($notification) {
            $data = $notification->data;
            return [
                'id' => $notification->id,
                'type' => $data['type'] ?? 'unknown',
                'group_name' => $data['group_name'] ?? 'Unknown Group',
                'message' => $data['message'] ?? 'No message',
                'created_at' => $notification->created_at,
                'read_at' => $notification->read_at
            ];
        }));
    }

    // Mark notification as read
    public function markAsRead(Request $request, $id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        
        if ($notification) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false, 'message' => 'Notification not found']);
    }
}
