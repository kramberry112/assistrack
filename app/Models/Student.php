<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Add office field accessor for compatibility
    public function getOfficeAttribute()
    {
        return $this->attributes['office'] ?? null;
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Evaluations
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
