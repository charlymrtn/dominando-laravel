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
}
