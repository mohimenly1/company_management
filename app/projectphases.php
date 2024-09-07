<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class projectphases extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'description',
        'start_date',
        'end_date',
    ];

    // Relationship with the project
    public function project()
    {
        return $this->belongsTo(projects::class,'project_id');
    }
}
