<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;
use App\Option;
use App\Page;
use App\Post;

class AdminController extends BaseController
{
    // TODO: Make sure the person is supposed to be here!
    
    public function getIndex()
    {
        return view('admin.index', ['options' => $this->options]);
    }

    public function getComponents()
    {
        return view('admin.components', ['options' => $this->options]);
    }
    
    public function postComponents(Request $request)
    {
        // Getting values implicitly to exclude any extras
        $navBar = $request->input('checkNavBar');
        $header = $request->input('checkHeader');
        $footer = $request->input('checkFooter');
        
        $this->options['navbar'] = isset($navBar) ? 1 : 0;
        $this->options['header'] = isset($header) ? 1 : 0;
        $this->options['footer'] = isset($footer) ? 1 : 0;
        
        // TODO:  Validate the data?
        Storage::disk('components')->put('navbar.blade.php', $request->input('navbarCode'));
        Storage::disk('components')->put('header.blade.php', $request->input('headerCode'));
        Storage::disk('components')->put('footer.blade.php', $request->input('footerCode'));
        
        if ($this->saveOptions())
        {
            return view('admin.components', ['options' => $this->options]);
        }
        else
        {
            die('There was a problem saving to the database');
        }
    }
    
    public function getSiteConfig()
    {
        return view('admin.site_config', ['options' => $this->options]);
    }
    
    public function postSiteConfig(Request $request)
    {
        // Getting values implicitly to exclude any extras
        $siteUrl = $request->input('site-url');
        $siteName = $request->input('site-name');
        $siteTagline = $request->input('site-tagline');
        
        // TODO:  Add validation
        
        $this->options['site_url'] = $siteUrl;
        $this->options['site_name'] = $siteName;
        $this->options['site_tagline'] = $siteTagline;
        
        if ($this->saveOptions())
        {
            return view('admin.site_config', ['options' => $this->options]);
        }
        else
        {
            die('There was a problem saving to the database');
        }
        
    }
    
    public function getEmail()
    {
        return view('admin.email_setup', ['options' => $this->options]);
    }
    
    public function getPages()
    {
        $pages = Page::all();
        return view('admin.pages', ['pages' => $pages]);
    }
    
    public function getReports()
    {
        return view('admin.reports', ['options' => $this->options]);
    }
    
    public function getStyling()
    {
        return view('admin.styling', ['options' => $this->options]);
    }
    
    
    /**
     * PUT methods
     */
    
    public function putAddpage(Request $request)
    {
        $page = new Page();
        $page->title = $request->input('page-title');
        $page->url = $request->input('page-url');
        $page->navbar = 1;
        $page->header_id = 1;
        $page->footer_id = 1;
        $page->save();
        
        return $page;
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
