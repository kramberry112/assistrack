<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;

class AdminAttendanceReportController extends Controller
{
    public function index()
    {
        // Get today's grouped attendance records
        $records = Attendance::getTodayGroupedRecords();
        $stats = Attendance::getTodayStats();

        // Optionally, enrich records with office info from Student model
        foreach ($records as &$record) {
            $student = Student::where('id_number', $record['id_number'])->first();
            $record['office'] = $student ? ($student->designated_office ?? '-') : '-';
            $record['date'] = isset($record['time_in']) ? $record['time_in']->format('Y-m-d') : '-';
            $record['status'] = ($record['time_in'] && $record['time_out']) ? 'Present' : 'Incomplete';
        }

        return view('admin.reports.attendance', [
            'records' => $records,
            'stats' => $stats
        ]);
    }
}
