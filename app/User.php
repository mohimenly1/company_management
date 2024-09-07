<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{ 
    // علاقة المستخدم كعضو فريق
  

use Notifiable;
use HasRoles;
use HasApiTokens;
/**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = [
'name', 'email', 'password','roles_name','Status', 'company_id',
];
/**
* The attributes that should be hidden for arrays.
*
* @var array
*/
protected $hidden = [
'password', 'remember_token',
];
/**
* The attributes that should be cast to native types.
*
* @var array
*/
protected $casts = [
'email_verified_at' => 'datetime',
'roles_name' => 'array',
];

   // العلاقة مع companies
   public function company()
   {
       return $this->belongsTo(companies::class, 'company_id');
   }

    public function teamMemberships()
    {
        return $this->hasMany(TeamMemmber::class);
    } 

}