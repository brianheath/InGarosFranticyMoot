<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Page;

class HomeController extends BaseController
{
    public function index()
    {
        return view('home', ['options' => $this->options]);
    }
    
    public function page($page_id) {
        $page = Page::where('url', $page_id)
                ->where('enabled', 1)
                ->first();
        
        if (!$page)
        {
            // If the page doesn't exist, show a 404
            return "PAGE NOT FOUND 404 ERROR";
        }
        
        return view('page', [
            'options' => $this->options,
            'page' => $page,
        ]);
        
    }
}
