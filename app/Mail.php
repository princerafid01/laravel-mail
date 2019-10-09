<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $guarded =[];
    public function attachments()
    {
    	return $this->hasMany('App\Attachment');
    }
}
