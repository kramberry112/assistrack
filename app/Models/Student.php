<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'student_name', 'course', 'year_level', 'id_number', 'age',
        'address', 'email', 'telephone', 'picture', 'designated_office',
        'matriculation', // <-- add this line
        // Family Background
        'father_name', 'father_age', 'father_occupation', 'father_deceased',
        'mother_name', 'mother_age', 'mother_occupation', 'mother_deceased', 
        'monthly_income', 'parent_consent',
        // Computer Literacy
        'is_literate', 'tools', 'can_commit', 'willing_overtime',
        'comfortable_clerical', 'strong_communication', 'willing_training', 'other_skills'
    ];

    // Add office field accessor for compatibility
    public function getOfficeAttribute()
    {
        return $this->designated_office;
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

    // Check if student has been evaluated
    public function isEvaluated()
    {
        return $this->evaluations()->exists();
    }
}
