<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class projectFiles extends Model
{
    protected $fillable = [
        'project_id',
        'uploaded_by',
        'file_path',
        'file_name',
    ];

    // Relationship with the project
    public function project()
    {
        return $this->belongsTo(projects::class,'project_id');
    }

    // Relationship with the user who uploaded the file
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
