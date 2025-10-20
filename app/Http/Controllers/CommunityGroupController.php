<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityGroup;

class CommunityGroupController extends Controller {

    public function index()
    {
        $groups = CommunityGroup::withCount('members')
            ->with(['owner', 'pendingRequests.user'])
            ->get();
        $groupMessages = [];
        foreach ($groups as $group) {
            $groupMessages[$group->id] = \App\Models\GroupMessage::where('community_group_id', $group->id)
                ->with('user:id,name,username,profile_photo')
                ->orderBy('created_at', 'asc')
                ->get();
        }
        return view('students.community.index', compact('groups', 'groupMessages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        CommunityGroup::create([
            'name' => $request->name,
            'description' => $request->description,
            'owner_id' => auth()->id(),
        ]);

        return redirect()->route('student.community')->with('success', 'Group created successfully!');
    }

    // Real-time chat: send message and broadcast event
    public function sendMessage(Request $request)
    {
        $request->validate([
            'group_id' => 'required|integer|exists:community_groups,id',
            'message' => 'required|string|max:1000',
        ]);

        $user = auth()->user();
        $groupId = $request->group_id;
        $message = $request->message;

        // Store message in DB
        \App\Models\GroupMessage::create([
            'community_group_id' => $groupId,
            'user_id' => $user->id,
            'message' => $message,
        ]);

        broadcast(new \App\Events\GroupMessageSent($groupId, $user->only(['id','name','username','profile_photo']), $message))->toOthers();

        return response()->json(['success' => true]);
    }

    public function join(Request $request)
    {
        $request->validate([
            'group_id' => 'required|integer|exists:community_groups,id',
        ]);
        $group = CommunityGroup::findOrFail($request->group_id);
        $group->members()->syncWithoutDetaching([auth()->id()]);
        return response()->json(['success' => true]);
    }
}
