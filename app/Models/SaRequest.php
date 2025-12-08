<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'office',
        'description',
        'requested_count',
        'status',
        'reason',
        'assigned_student_id',
        'assigned_at',
        'approved_at',
        'rejected_at'
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    // Relationship with assigned Student
    public function assignedStudent()
    {
        return $this->belongsTo(Student::class, 'assigned_student_id');
    }

    // Check if request is pending
    public function isPending()
    {
        return $this->status === 'pending';
    }

    // Check if request is approved
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    // Check if request is rejected
    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    // Check if request has been assigned
    public function isAssigned()
    {
        return !is_null($this->assigned_student_id);
    }

    // Check if request is fulfilled (approved and assigned)
    public function isFulfilled()
    {
        return $this->status === 'approved' && $this->isAssigned();
    }

    // Get all assigned students for this office request (including multi-assignments)
    public function getAllAssignedStudents()
    {
        if ($this->requested_count == 1) {
            return $this->assignedStudent ? collect([$this->assignedStudent]) : collect([]);
        }

        // For multi-assignment requests, find all related assignments
        // Get the base description (remove any multi-assignment suffix)
        $baseDescription = preg_replace('/ \(Multi-assignment #\d+\)$/', '', $this->description);
        
        return \App\Models\Student::whereIn('id', function($query) use ($baseDescription) {
            $query->select('assigned_student_id')
                ->from('sa_requests')
                ->where('office', $this->office)
                ->where('status', 'approved')
                ->whereNotNull('assigned_student_id')
                ->where(function($q) use ($baseDescription) {
                    $q->where('description', $baseDescription)
                      ->orWhere('description', 'like', $baseDescription . ' (Multi-assignment #%');
                });
        })->distinct()->get();
    }

    // Get count of assigned students for this request
    public function getAssignedCount()
    {
        return $this->getAllAssignedStudents()->count();
    }

    // Check if all requested positions are filled
    public function isFullyAssigned()
    {
        return $this->getAssignedCount() >= $this->requested_count;
    }
}
