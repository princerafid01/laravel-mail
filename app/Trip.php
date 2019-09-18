<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public function created_by(){
        return $this->belongsTo('App\User', 'user_id');
    }
    public function ship(){
        return $this->belongsTo('App\Ship');
    }
    public function transactions(){
        return $this->hasMany('App\Transaction');
    }
    public static function boot() {
        parent::boot();

        static::deleting(function($tr) {
            $tr->transactions()->delete();
        });
    }
}
