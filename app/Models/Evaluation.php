<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evaluation extends Model
{
    protected $fillable = [
        'student_id',
        'evaluator_id',
        'department',
        'problem_solving',
        'writing_skills',
        'oral_communication',
        'adaptability',
        'service',
        'attention_to_detail',
        'attitude',
        'interpersonal_communication',
        'creativity',
        'confidentiality',
        'initiative',
        'teamwork',
        'dependability',
        'punctuality',
        'making_use_of_time_wisely',
        'overall_comments',
        'submitted_at'
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function evaluator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }

    // Calculate average numeric rating (excluding N/A values)
    public function getAverageRatingAttribute()
    {
        $numericFields = [
            'problem_solving', 'writing_skills', 'oral_communication',
            'adaptability', 'service', 'attention_to_detail', 'attitude'
        ];
        
        $attributeFields = [
            'interpersonal_communication', 'creativity', 'confidentiality',
            'initiative', 'teamwork', 'dependability', 'punctuality',
            'making_use_of_time_wisely'
        ];

        $total = 0;
        $count = 0;

        // Add work skills ratings
        foreach ($numericFields as $field) {
            if ($this->$field && is_numeric($this->$field)) {
                $total += $this->$field;
                $count++;
            }
        }

        // Add work attributes ratings (exclude N/A)
        foreach ($attributeFields as $field) {
            if ($this->$field && $this->$field !== 'N/A' && is_numeric($this->$field)) {
                $total += $this->$field;
                $count++;
            }
        }

        return $count > 0 ? round($total / $count, 2) : 0;
    }
}
