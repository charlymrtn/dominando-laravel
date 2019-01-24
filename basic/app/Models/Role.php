<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'roles';

    protected $fillable = [
        'key',
        'name',
        'description'
];

    public function users()
    {
        return $this->hasMany('App\User','role_id','id');
    }
}
