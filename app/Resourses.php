<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resourses extends Model
{
    protected $fillable = [
        'project_id', 'name', 'description', 'quantity', 'cost',
    ];

    // علاقة الانتماء إلى المشروع
    public function project()
    {
        return $this->belongsTo(projects::class);
    }
}
