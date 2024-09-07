<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class projects extends Model
{
    use SoftDeletes;

    protected $fillable = [
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

  // Relationship with the company
  public function company()
  {
      return $this->belongsTo(companies::class);
  }

  // Relationship with the user who created the project
  public function creator()
  {
      return $this->belongsTo(User::class, 'created_by');
  }

  // Relationship with project phases
  public function phases()
  {
    return $this->hasMany(projectphases::class, 'project_id');
  }

  // Relationship with project details
  public function details()
  {
      return $this->hasOne(project_details::class, 'id_project');
  }

  // Relationship with project files
  public function files()
  {
      return $this->hasMany(projectFiles::class,'project_id');
  }
}
