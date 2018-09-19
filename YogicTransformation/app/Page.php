<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function footer()
    {
        return $this->hasOne('App\Footer');
    }
    
    public function header()
    {
        return $this->hasOne('App\Header');
    }
    
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    
}
