<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    //
    protected $table = 'zonas';

    protected $fillable = ['key','name'];

    public function notable()
    {
        return $this->morphTo();
    }

    public function getEntidadTipoAttribute()
    {
        return collect(explode('\\',$this->zonable_type))->last();

    }

    public function entidad()
    {
        return $this->belongsTo($this->zonable_type,'zonable_id','id');
    }
}
