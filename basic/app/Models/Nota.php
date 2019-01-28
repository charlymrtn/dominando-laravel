<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    //
    protected $table = 'notas';

    protected $fillable = ['body'];

    public function mensaje()
    {
        return $this->belongsTo('App\Models\Mensaje','id','mensaje_id');
    }
}
