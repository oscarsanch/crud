<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Employee extends Model
{
    use NodeTrait;

    //
    public function manager()
    {
        return $this->belongsTo('App\Manager');
    }

    public function position()
    {
        return $this->belongsTo('App\Position');
    }
}
