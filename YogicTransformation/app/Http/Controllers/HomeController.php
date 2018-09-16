<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Footer;
use App\Header;
use App\Page;

class HomeController extends BaseController
{
    public function index()
    {
        return view('home', ['options' => $this->options]);
    }
    
    public function about()
    {
        return "This will be the about page";
    }
    
    public function page($page_id) {
        $page = Page::where('url', $page_id)->first();
        $header = Header::find($page['header_id']);
        $footer = Footer::find($page['footer_id']);
//return $page;
        return view('page', [
            'options' => $this->options,
            'page' => $page,
            'header' => $header,
            'footer' => $footer,
        ]);
        
        // If the page doesn't exist, show a 404 or something
    }
}
