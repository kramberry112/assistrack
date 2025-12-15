<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'priority', 'due_date', 'status', 'progress', 'started_date', 'started_time', 'verified', 'semester', 'school_year'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
