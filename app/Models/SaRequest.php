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
}
