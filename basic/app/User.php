<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hasRoles(array $roles)
    {
        foreach ($roles as $role){
            if ($this->role->key === $role) return true;
        }

        return false;
    }

    public function isAdmin()
    {
        return $this->hasRoles(['admin']);
    }

    public function role()
    {
        return $this->hasOne('App\Models\Role','id','role_id');
    }
}
