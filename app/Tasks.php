<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = [
        'project_id', 'team_member_id' ,'title', 'description', 'status', 'Value_Status',
    ];

    public function project()
    {
        return $this->belongsTo(projects::class);
    }

    // علاقة التعليقات على المهمة
    public function comments()
    {
        return $this->hasMany(TaskComment::class, 'task_id'); // explicitly mention 'task_id'
    }


    // علاقة الانتماء إلى صاحب المهمة (المستخدم)
    public function TeamMemmber()
    {
        return $this->belongsTo(User::class, 'team_member_id');
    }
}
