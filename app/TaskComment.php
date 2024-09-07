<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    protected $fillable = [
        'task_id', 'user_id', 'comment',
    ];

    public function task()
    {
        return $this->belongsTo(Tasks::class, 'task_id'); // explicitly mention 'task_id'
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
