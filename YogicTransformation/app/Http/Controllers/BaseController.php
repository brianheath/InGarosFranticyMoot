<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Option;
use App\Page;

class BaseController extends Controller
{
    public $options;
    public $links;
    
    public function __construct()
    {
//        $this->middleware('auth');
        
        // Get options for the website
        $this->options = Option::latest()->first();
        unset($this->options['id']);
        unset($this->options['created_at']);
        unset($this->options['updated_at']);
        
        // Get pages for the navbar
        $this->links = Page::where('published', '=', '1')
                        ->get(['url', 'title']);
    }
    
    protected function saveOptions() {
        // Creating a new option entry to keep a record of the changes
        $options = new Option;
        $options->homepage_id = $this->options['homepage_id'];
        $options->nav_brand = $this->options['nav_brand'];
        $options->site_url = $this->options['site_url'];
        $options->site_name = $this->options['site_name'];
        $options->site_tagline = $this->options['site_tagline'];
        return $options->save();
    }

}
