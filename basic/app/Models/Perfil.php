<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //
    protected $table = 'perfiles';

    protected $fillable = [
        'key',
        'name',
        'description'
    ];

    public function usuarios()
    {
        return $this->belongsToMany('App\User','perfil_usuario','perfil_id','user_id');
    }
}
