<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    //
    public function employee()
    {
        return $this->hasMany('App\Employee');
    }

    public function position()
    {
        return $this->belongsTo('App\Position');
    }
}
