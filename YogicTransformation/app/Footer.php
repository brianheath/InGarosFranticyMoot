<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    
    public $timestamps = false;
    
    public function page()
    {
        $this->belongsToMany('App\Page');
    }
    
}
