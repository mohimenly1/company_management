<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class companies extends Model
{

    protected $fillable = [
        'name',
        'address',
        'phone',







    ];
    public function projects()
    {
        return $this->hasMany(projects::class);
    }

    // علاقة الشركة بالمدير
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
