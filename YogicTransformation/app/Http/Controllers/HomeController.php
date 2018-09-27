<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Page;

class HomeController extends BaseController
{
    public function __construct() {
        parent::__construct();
        $this->options['container_class'] = $this->options['full_width'] 
                ? 'container-fluid' : 'container';
    }
    
    public function index()
    {
        // TODO: Make sure page exists
        $page = Page::find($this->options['homepage_id']);
        
        if (!$page)
        {
            abort(404);
        }
        
        return view('page', [
            'links' => $this->links,
            'options' => $this->options,
            'page' => $page,
        ]);
    }
    
    public function page($page_id) {
        $page = Page::where('url', $page_id)
                ->where('published', 1)
                ->first();
        
        if (!$page)
        {
            abort(404);
        }
        
        return view('page', [
            'links' => $this->links,
            'options' => $this->options,
            'page' => $page,
        ]);
        
    }
}
