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
}
