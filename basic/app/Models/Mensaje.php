<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    //
    protected $table = 'mensajes';

    protected $fillable = ['nombre','correo','telefono','mensaje'];

    public function usuario()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function notas()
    {
        return $this->morphMany('App\Models\Nota','notable','notable_type','notable_id','id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class,'tagglable','taggables');
    }

    public function getNameAttribute()
    {
        return $this->nombre;
    }

    public function getEmailAttribute()
    {
        return $this->correo;
    }
}
