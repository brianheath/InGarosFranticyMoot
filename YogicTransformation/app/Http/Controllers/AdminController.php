<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\option;

class AdminController extends BaseController
{
    // TODO: Make sure the person is supposed to be here!
    
    public function getIndex()
    {
        return view('admin.index', ['options' => $this->options]);
    }

    public function getPageOptions()
    {
        return view('admin.page_options', ['options' => $this->options]);
    }
    
    public function postPageOptions(Request $request)
    {
        // Getting values implicitly to exclude any extras
        $navBar = $request->input('checkNavBar');
        $header = $request->input('checkHeader');
        $footer = $request->input('checkFooter');
        
        $this->options['navbar'] = isset($navBar) ? 1 : 0;
        $this->options['header'] = isset($header) ? 1 : 0;
        $this->options['footer'] = isset($footer) ? 1 : 0;
        
        if ($this->saveOptions())
        {
            return view('admin.page_options', ['options' => $this->options]);
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
    
    public function getEmailSetup()
    {
        return view('admin.email_setup', ['options' => $this->options]);
    }
    
    public function getStyling()
    {
        return view('admin.styling', ['options' => $this->options]);
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
