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
        
        usort($neworder, $this->arrSortObjsByKey('id'));

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
    
    
    /**
     * Sort a multi-domensional array of objects by key value
     * Usage: usort($array, arrSortObjsByKey('VALUE_TO_SORT_BY'));
     * Expects an array of objects. 
     *
     * @param String    $key  The name of the parameter to sort by
     * @param String 	$order the sort order
     * @return A function to compare using usort
     */ 
    function arrSortObjsByKey($key, $order = 'DESC') {
	return function($a, $b) use ($key, $order) {
            // Swap order if necessary
            if ($order == 'DESC') {
                    list($a, $b) = array($b, $a);
            } 
            // Check data type
            if (is_numeric($a->$key)) {
                    return $a->$key - $b->$key; // compare numeric
            } else {
                    return strnatcasecmp($a->$key, $b->$key); // compare string
            }
	};
    }
    
}
