<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    //
    protected $table = 'notas';

    protected $fillable = ['body'];

    public function notable()
    {
        return $this->morphTo();
    }

    public function getEntidadTipoAttribute()
    {
        return collect(explode('\\',$this->notable_type))->last();

    }

    public function entidad()
    {
        return $this->belongsTo($this->notable_type,'notable_id','id');
    }


}
