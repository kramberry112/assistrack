<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Notifications\NewApplicationSubmitted;

class Application extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(function ($application) {
            // Send notification to all admin users
            $adminUsers = User::where('role', 'admin')->get();
            foreach ($adminUsers as $admin) {
                $admin->notify(new NewApplicationSubmitted($application));
            }
        });
    }

    /**
     * Get the full student name (backward compatibility accessor).
     */
    public function getStudentNameAttribute()
    {
        $lastName = $this->last_name ?? '';
        $firstName = $this->first_name ?? '';
        $middleName = $this->middle_name ?? '';
        
        if (!$lastName && !$firstName && !$middleName) {
            return '';
        }
        
        $name = $lastName;
        if ($firstName || $middleName) {
            $name .= ', ' . trim($firstName . ' ' . $middleName);
        }
        
        return $name;
    }
}
