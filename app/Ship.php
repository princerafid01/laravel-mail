<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    public function trips(){
        return $this->hasMany('App\Trip');
    }

    public function transactions(){
        return $this->hasManyThrough('App\Transaction', 'App\Trip');
    }
}
