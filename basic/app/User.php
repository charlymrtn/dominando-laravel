<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

use App\Models\Tag;

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

    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function hasRoles(array $roles)
    {
        foreach ($roles as $role){
            if ($this->role->key === $role) return true;
        }

        return false;
    }

    public function hasPerfil($perfilID)
    {
        foreach ($this->perfiles as $perfil)
        {
            if ($perfil->id === $perfilID) return true;
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

    public function mensajes()
    {
        return $this->hasMany('App\Models\Mensaje','user_id','id');
    }

    public function perfiles()
    {
        return $this->belongsToMany('App\Models\Perfil','perfil_usuario','user_id','perfil_id');
    }

    public function notas()
    {
        return $this->morphMany('App\Models\Nota','notable','notable_type','notable_id','id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class,'tagglable','taggables')->withTimestamps();
    }
}
