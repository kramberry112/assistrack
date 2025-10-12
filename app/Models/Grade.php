<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'student_name',
        'year_level',
        'semester',
        'subjects',
        'proof_url',
    ];

    protected $casts = [
        'subjects' => 'array',
    ];
}
