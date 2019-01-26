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
}