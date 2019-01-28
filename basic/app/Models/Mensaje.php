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
        return $this->hasMany('App\Models\Nota','mensaje_id','id');
    }
}
