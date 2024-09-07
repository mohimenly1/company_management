<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $fillable = [
        'name', 'project_id', 'leader_id', 'company_id'
    ];

    // Relationship to the project
    public function project()
    {
        return $this->belongsTo(projects::class, 'project_id');
    }

    // Relationship to the leader (User)
    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    // Relationship to the company
    public function company()
    {
        return $this->belongsTo(companies::class, 'company_id');
    }

    // Relationship to team members
    public function members()
    {
        return $this->hasMany(TeamMemmber::class, 'team_id');
    }
}
