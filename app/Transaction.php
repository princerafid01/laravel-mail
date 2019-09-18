<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function trip(){
        return $this->belongsTo('App\Trip');
    }
    public function created_by(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
