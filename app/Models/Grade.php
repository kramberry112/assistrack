<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
        'user_id',
        'student_name',
        'year_level',
        'semester',
        'school_year',
        'subjects',
        'proof_url',
        'schedule_url',
    ];

    protected $casts = [
        'subjects' => 'array',
    ];

    // Relationship to Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
