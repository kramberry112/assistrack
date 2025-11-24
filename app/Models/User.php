<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // Relationship: completed student tasks
    public function studentTasks()
    {
        return $this->hasMany(\App\Models\StudentTask::class, 'user_id');
    }

    // Relationship with Student
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    // Get students assigned to this office user
    public function assignedStudents()
    {
        if ($this->role === 'offices' && $this->office_name) {
            return \App\Models\Student::where('designated_office', $this->office_name)->get();
        }
        return collect();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'office_name',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationship with Grades (if user is a student)
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    // Relationship with Attendances (if user is a student)
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Get user's latest grade record
    public function latestGrade()
    {
        return $this->hasOne(Grade::class)->latest();
    }
}
