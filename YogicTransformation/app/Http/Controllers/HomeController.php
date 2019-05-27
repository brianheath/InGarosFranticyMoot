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
    
    public function showPage($page)
    {
        if (!$page)
        {
            abort(404);
        }
        
        // Replace keywords
        $page->header->markup = $this->replaceKeywords($page->header->markup);
        $page->footer->markup = $this->replaceKeywords($page->footer->markup);
        
        // Reorder posts
        $page->posts = $this->reorderPosts($page->posts);
        
        return view('page', [
            'css' => $this->css,
            'links' => $this->links,
            'options' => $this->options,
            'page' => $page,
        ]);
    }
    
    public function index()
    {
        return $this->showPage(Page::find($this->options['homepage_id']));
    }
    
    private function reorderPosts($posts)
    {
        $neworder = [];
        
        foreach ($posts as $post)
        {
            $neworder[$post->id] = $post;
        }
        
        return $neworder;
    }
    
    private function replaceKeywords($text)
    {
        $search = [
            "@@site_name",
            "@@site_tagline",
            "@@site_domain",
        ];
        
        $replace = [
            $this->options['site_name'],
            $this->options['site_tagline'],
            $this->options['site_url'],
        ];
        
        return str_replace($search, $replace, $text);
    }
    
    public function page($page_id)
    {
        $page = Page::where('url', $page_id)
                ->where('published', 1)
                ->first();
        
        return $this->showPage($page);
    }
}
