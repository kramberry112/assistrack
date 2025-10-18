<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller {
    // Helper for preset date ranges
    private function getPresetDates($preset)
    {
        $dates = [];
        switch ($preset) {
            case 'today':
                $dates['from'] = now()->format('Y-m-d');
                $dates['to'] = now()->format('Y-m-d');
                break;
            case 'yesterday':
                $dates['from'] = now()->subDay()->format('Y-m-d');
                $dates['to'] = now()->subDay()->format('Y-m-d');
                break;
            case 'this_week':
                $dates['from'] = now()->startOfWeek()->format('Y-m-d');
                $dates['to'] = now()->endOfWeek()->format('Y-m-d');
                break;
            case 'last_week':
                $dates['from'] = now()->subWeek()->startOfWeek()->format('Y-m-d');
                $dates['to'] = now()->subWeek()->endOfWeek()->format('Y-m-d');
                break;
            case 'this_month':
                $dates['from'] = now()->startOfMonth()->format('Y-m-d');
                $dates['to'] = now()->endOfMonth()->format('Y-m-d');
                break;
            case 'last_month':
                $dates['from'] = now()->subMonth()->startOfMonth()->format('Y-m-d');
                $dates['to'] = now()->subMonth()->endOfMonth()->format('Y-m-d');
                break;
        }
        return $dates;
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Get all today's records
        $allRecords = Attendance::getTodayGroupedRecords();
        
        // Filter by office if user is office role
        if ($user && $user->role === 'offices' && $user->office_name) {
            $records = collect($allRecords)->filter(function ($record) use ($user) {
                return $record['office'] === $user->office_name;
            })->values()->toArray();
        } else {
            $records = $allRecords;
        }
        
        // Calculate filtered stats
        $stats = [
            'total' => count($records),
            'clock_ins' => collect($records)->whereNotNull('time_in')->count(),
            'clock_outs' => collect($records)->whereNotNull('time_out')->count(),
            'unique_users' => collect($records)->pluck('id_number')->unique()->count()
        ];
        
        return view('offices.attendance.index', [
            'todayRecords' => $records,
            'stats' => $stats,
            'officeName' => $user && $user->office_name ? $user->office_name : null
        ]);
    }

    // Store attendance record
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_number' => 'required|string|max:50',
            'name' => 'nullable|string|max:255',
            'action' => 'required|in:in,out'
        ]);

        // Check if student ID exists in the admin student list
        $student = \App\Models\Student::where('id_number', $validated['id_number'])->first();
        if (!$student) {
            return redirect()->back()->withInput()->withErrors(['id_number' => 'Student ID not found. Please check and try again.']);
        }

        // Prevent time out if there is no time in record for today
        if ($validated['action'] === 'out') {
            $hasTimeIn = Attendance::where('id_number', $validated['id_number'])
                ->whereDate('clock_time', now()->toDateString())
                ->where('action', 'in')
                ->exists();
            if (!$hasTimeIn) {
                return redirect()->back()->withInput()->withErrors(['id_number' => 'Cannot time out without a time in record for today.']);
            }
        }

        Attendance::create([
            'id_number' => $validated['id_number'],
            'name' => $student->student_name, // Use student_name from Student model
            'action' => $validated['action'],
            'clock_time' => now()
        ]);

        $actionText = $validated['action'] === 'in' ? 'timed in' : 'timed out';
        $message = $student->student_name
            ? $student->student_name . " successfully {$actionText}!"
            : "Successfully {$actionText}!";

        return redirect()->back()->with('success', $message);
    }
    // Attendance records with filtering and pagination
    public function records(Request $request)
    {
    $date = $request->input('date') ?? now()->toDateString();
    $records = Attendance::getGroupedRecordsByDate($date);
        // Calculate stats for selected date
        $stats = [
            'total' => count($records),
            'clock_ins' => collect($records)->whereNotNull('time_in')->count(),
            'clock_outs' => collect($records)->whereNotNull('time_out')->count(),
            'unique_users' => collect($records)->pluck('id_number')->unique()->count(),
        ];
        return view('admin.reports.attendance', compact('records', 'stats'));
    }
}
