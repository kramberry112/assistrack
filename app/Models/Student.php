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

    // Relationship with Grades
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    // Relationship with Attendances
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Get student's latest grade record
    public function latestGrade()
    {
        return $this->hasOne(Grade::class)->latest();
    }

    // Relationship with SA Requests (where this student is assigned as SA)
    public function assignedSaRequests()
    {
        return $this->hasMany(SaRequest::class, 'assigned_student_id');
    }

    // Check if student is currently assigned as SA to any office
    public function isAssignedAsSa()
    {
        return $this->assignedSaRequests()->where('status', 'approved')->exists();
    }

    // Get offices where student is assigned as SA
    public function getAssignedOffices()
    {
        return $this->assignedSaRequests()->where('status', 'approved')->pluck('office');
    }
}
