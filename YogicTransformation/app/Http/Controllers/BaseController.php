<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\option;

class BaseController extends Controller
{
    public $options;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
        
        // Get options for the website
        $this->options = option::latest()->first();
    }

}
