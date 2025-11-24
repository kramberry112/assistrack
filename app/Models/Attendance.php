<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model {
    use HasFactory;

    // Relationship to Student
    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class, 'student_id', 'id');
    }

    // Relationship to User  
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    // Legacy relationship using id_number for backward compatibility
    public function studentByIdNumber()
    {
        return $this->belongsTo(\App\Models\Student::class, 'id_number', 'id_number');
    }

    // For backward compatibility
    public static function getTodayGroupedRecords()
    {
        return self::getGroupedRecordsByDate(Carbon::today());
    }
    use HasFactory;

    protected $fillable = [
        'student_id',
        'user_id',
        'id_number',
        'name',
        'action',
        'clock_time'
    ];

    protected $casts = [
        'clock_time' => 'datetime'
    ];

    // Get attendance records (grouped by student) for a given date
    public static function getGroupedRecordsByDate($date)
    {
        $records = self::whereDate('clock_time', $date)
            ->orderBy('clock_time', 'asc')
            ->get();

        // Get all students for mapping office
        $students = \App\Models\Student::whereIn('id_number', $records->pluck('id_number')->unique())->get()->keyBy('id_number');

        // Group by id_number
        $grouped = $records->groupBy('id_number');
        $result = [];
        foreach ($grouped as $id_number => $items) {
            $student_name = $items->first()->name;
            $student_office = isset($students[$id_number]) ? ($students[$id_number]->designated_office ?? '-') : '-';
            $time_in = $items->where('action', 'in')->sortBy('clock_time')->first();
            $time_out = $items->where('action', 'out')->sortByDesc('clock_time')->first();
            $in_time = $time_in ? $time_in->clock_time : null;
            $out_time = $time_out ? $time_out->clock_time : null;
            $total_hours = null;
            if ($in_time && $out_time) {
                $total_hours = $in_time->diffInMinutes($out_time) / 60;
            }
            $status = ($in_time && $out_time) ? 'Present' : 'Incomplete';
            $result[] = [
                'id_number' => $id_number,
                'name' => $student_name,
                'office' => $student_office,
                'time_in' => $in_time,
                'time_out' => $out_time,
                'total_hours' => $total_hours,
                'status' => $status
            ];
        }
        return $result;
    }


    // Get today's statistics
    public static function getTodayStats()
    {
        $records = collect(self::getTodayGroupedRecords());

        return [
            'total' => $records->count(),
            'clock_ins' => $records->whereNotNull('time_in')->count(),
            'clock_outs' => $records->whereNotNull('time_out')->count(),
            'unique_users' => $records->pluck('id_number')->unique()->count()
        ];
    }

    // Get user's last action
    public static function getLastAction($idNumber)
    {
        return self::where('id_number', $idNumber)
            ->whereDate('clock_time', Carbon::today())
            ->latest('clock_time')
            ->first();
    }
}
