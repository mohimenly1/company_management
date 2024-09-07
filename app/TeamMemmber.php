<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMemmber extends Model
{
    protected $fillable = [
        'team_id', 'user_id',
    ];

    public function team()
    {
        return $this->belongsTo(Teams::class, 'team_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to tasks
    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'team_member_id');
    }
}
