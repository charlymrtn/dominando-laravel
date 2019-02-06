<?php

namespace App\Models;

use App\User;
use App\Models\Mensaje;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table = 'tags';

    protected $fillable = [
        'name'
    ];

    public function mensajes()
    {
        return $this->morphedByMany(Mensaje::class,'tagglable','taggables');
    }

    public function usuarios()
    {
        return $this->morphedByMany(User::class,'tagglable','taggables');
    }
}
