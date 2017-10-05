<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //

    public function manager()
    {
        return $this->hasMany('App\Manager');
    }

    public function employee()
    {
        return $this->hasMany('App\Employee');
    }
}
