<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Page;

class HomeController extends BaseController
{
    public function index()
    {
        // TODO: Make sure page exists
        $page = Page::find($this->options['homepage_id']);
        return view('page', [
            'options' => $this->options,
            'page' => $page,
        ]);
    }
    
    public function page($page_id) {
        $page = Page::where('url', $page_id)
                ->where('enabled', 1)
                ->first();
        
        if (!$page)
        {
            abort(404);
        }
        
        return view('page', [
            'options' => $this->options,
            'page' => $page,
        ]);
        
    }
}
