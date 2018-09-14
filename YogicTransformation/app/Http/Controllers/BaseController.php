<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Option;

class BaseController extends Controller
{
    public $options;
    
    public function __construct()
    {
//        $this->middleware('auth');
        
        // Get options for the website
        $this->options = option::latest()->first();
        unset($this->options['id']);
        unset($this->options['created_at']);
        unset($this->options['updated_at']);
    }
    
    protected function saveOptions() {
        // Creating a new option entry to keep a record of the changes
         $options = new option;
         $options->navbar = $this->options['navbar'];
         $options->header = $this->options['header'];
         $options->footer = $this->options['footer'];
         $options->site_url = $this->options['site_url'];
         $options->site_name = $this->options['site_name'];
         $options->site_tagline = $this->options['site_tagline'];
         $options->content = 1;
         return $options->save();
    }

}
