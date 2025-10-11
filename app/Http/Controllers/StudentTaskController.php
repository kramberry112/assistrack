<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\StudentTask;
use App\Events\StudentTaskCreated;

class StudentTaskController extends Controller {
    public function dashboard()
    {
        $userId = Auth::id();
        $tasks = StudentTask::where('user_id', $userId)->orderBy('due_date')->get();
        $grouped = [
            'todo' => $tasks->where('status', 'todo'),
            'in_progress' => $tasks->where('status', 'in_progress'),
            'completed' => $tasks->where('status', 'completed'),
            // Only show tasks that are NOT completed and due today or earlier
            'due' => $tasks->filter(function($task) {
                return $task->status !== 'completed' && $task->due_date <= now()->toDateString();
            }),
        ];
        return view('students.dashboard.index', compact('grouped'));
    }

    public function tasksForWeek(Request $request)
    {
        $userId = Auth::id();
        $start = $request->query('start'); // format: YYYY-MM-DD
        $end = $request->query('end');     // format: YYYY-MM-DD
        $tasks = StudentTask::where('user_id', $userId)
            ->whereDate('due_date', '>=', $start)
            ->whereDate('due_date', '<=', $end)
            ->get(['title', 'priority', 'due_date']);
        $tasks = $tasks->map(function($task) {
            $date = date('Y-n-j', strtotime($task->due_date));
            return [
                'title' => $task->title,
                'priority' => $task->priority,
                'due_date' => $date
            ];
        });
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:critical,medium,not_urgent',
            'due_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $task = StudentTask::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'status' => 'todo',
        ]);

        // Broadcast event for real-time office update
        broadcast(new StudentTaskCreated([
            'id' => $task->id,
            'user_name' => $task->user ? $task->user->name : 'Unknown',
            'title' => $task->title,
            'priority' => $task->priority,
            'due_date_formatted' => \Carbon\Carbon::parse($task->due_date)->format('F d, Y'),
            'verified' => (bool)$task->verified,
        ]))->toOthers();

        // Return the created task for AJAX instant display
        return response()->json([
            'success' => true,
            'task' => [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'priority' => $task->priority,
                'due_date' => $task->due_date,
                'status' => $task->status,
                'created_at' => $task->created_at,
            ]
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $task = StudentTask::where('user_id', Auth::id())->findOrFail($id);
        $validator = \Validator::make($request->all(), [
            'status' => 'required|in:todo,in_progress,completed',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }
        $task->status = $request->status;
        if ($request->status === 'in_progress' && !$task->started_date && !$task->started_time) {
            $task->started_date = now()->toDateString(); // Y-m-d
            $task->started_time = now()->toTimeString(); // H:i:s
        }
        $task->save();
        return response()->json([
            'success' => true,
            'started_date' => $task->started_date ? (\Carbon\Carbon::parse($task->started_date)->format('F d, Y')) : null,
            'started_time' => $task->started_time ? (date('g:i A', strtotime($task->started_time))) : null
        ]);
    }

    public function updateProgress(Request $request, $id)
    {
        $task = StudentTask::findOrFail($id);
        $progress = (int) $request->input('progress');
        $progress = max(0, min(100, $progress)); // Clamp between 0 and 100
        $task->progress = $progress;
        $task->save();
        return response()->json(['success' => true, 'progress' => $progress]);
    }
    public function tasksForMonth(Request $request)
    {
        $userId = Auth::id();
        $year = (int) $request->query('year');
        $month = (int) $request->query('month');
        $tasks = StudentTask::where('user_id', $userId)
            ->whereYear('due_date', $year)
            ->whereMonth('due_date', $month)
            ->get(['title', 'priority', 'due_date']);
        // Format due_date as YYYY-M-D for JS eventKey
        $tasks = $tasks->map(function($task) {
            $date = date('Y-n-j', strtotime($task->due_date));
            return [
                'title' => $task->title,
                'priority' => $task->priority,
                'due_date' => $date
            ];
        });
        return response()->json($tasks);
    }
}
