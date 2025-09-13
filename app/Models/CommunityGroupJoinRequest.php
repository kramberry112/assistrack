<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityGroupJoinRequest extends Model
{
    protected $fillable = [
        'community_group_id',
        'user_id',
        'status', // pending, accepted, rejected
    ];

    public function communityGroup()
    {
        return $this->belongsTo(CommunityGroup::class, 'community_group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
