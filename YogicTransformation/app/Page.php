<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
//    public function header()
//    {
//        return $this->hasOne('App\Header');
//    }
//    
//    public function footer()
//    {
//        return $this->hasOne('App\Footer');
//    }
    
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    
}
