<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityGroup extends Model
{
    protected $fillable = [
        'name',
        'description',
        'owner_id',
    ];
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Example relationship for member count
    public function members()
    {
        return $this->belongsToMany(User::class, 'community_group_user');
    }

    public function getMembersCountAttribute()
    {
        return $this->members()->count();
    }

    // Pending member requests relationship
    public function pendingRequests()
    {
        return $this->hasMany(CommunityGroupJoinRequest::class, 'community_group_id')
            ->where('status', 'pending')
            ->with('user');
    }
}
