<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_details extends Model
{
    protected $fillable = [
        'id_project',
        'project_name',
        'description',
        'created_by',
        'company_id',
        'budget',
        'status',
        'Value_Status',
        'start_date',
        'end_date',
    ];

    // Relationship with the project
    public function project()
    {
        return $this->belongsTo(projects::class, 'id_project');
    }

    // Relationship with the user who created the project
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relationship with the company
    public function company()
    {
        return $this->belongsTo(companies::class);
    }
}
