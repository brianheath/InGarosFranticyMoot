<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Footer;
use App\Header;
use App\Page;
use App\Post;
use App\User;

class AdminController extends BaseController
{
    // TODO: Make sure the person is supposed to be here!
    
    public function getIndex()
    {
        $pages = Page::all();
        return view('admin.index', [
            'options' => $this->options, 
            'pages' => $pages,
        ]);
    }

    public function getComponents()
    {
        return view('admin.components', ['options' => $this->options]);
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
    
    public function getPost($id)
    {
        return json_encode(Post::find($id));
    }
    
    public function getPosts()
    {
        $posts = Post::all();
        $pages = Page::all(['id', 'title']);
        
        return view('admin.posts', [
            'posts' => $posts,
            'pages' => $pages,
        ]);
    }
    
    public function getReports()
    {
        return view('admin.reports', ['options' => $this->options]);
    }
    
    public function getSiteConfig()
    {
        return view('admin.site_config', ['options' => $this->options]);
    }
    
    public function getStyling()
    {
        return view('admin.styling', ['options' => $this->options]);
    }
    
    public function getUsers()
    {
        return view('admin.users', ['users' => User::all()]);
    }
    
    
    public function editPage($id)
    {
        $page = Page::find($id);
        $page['is_homepage'] = $page['id'] == $this->options['homepage_id'] ? true : false;
        
        return view('admin.edit_page', [
            'links' => $this->links,
            'options' => $this->options,
            'page' => $page,
        ]);
    }
    
    
    /**
     * PUT methods
     */
    
    public function putAddpage(Request $request)
    {
        $header = new Header(['markup' => $request->input('header-code')]);
        $footer = new Footer(['markup' => $request->input('footer-code')]);
        $header->save();
        $footer->save();
        $navbar = $request->input('check-navbar') !== null ? 1 : 0;
        
        $page = new Page();
        $page->title = $request->input('page-title');
        $page->url = $request->input('page-url');
        $page->navbar = $navbar;
        $page->header_id = $header->id;
        $page->footer_id = $footer->id;
        $page->save();
        
        $page->header()->save($header);
        $page->footer()->save($footer);
        
        return redirect()->action('AdminController@getPages')->with('status', 'Page added');
    }
    
    public function putAddpost(Request $request)
    {
        $show_date = $request->input('check-show-date') !== null ? 1 : 0;
        $show_author = $request->input('check-show-author') !== null ? 1 : 0;
        $published = $request->input('check-publish') !== null ? 1 : 0;
        
        $post = new Post();
        $post->title = $request->input('post-title');
        $post->body = $request->input('post-body');
        $post->page_id = $request->input('parent-page-id');
        $post->user_id = 1; // TODO: Get the user id of the person that is logged in
        $post->show_date = $show_date;
        $post->show_author = $show_author;
        $post->published = $published;
        $post->save();
        
        return redirect()->action('AdminController@getPosts');
    }
    
    public function updatePage($id, Request $request)
    {
        $navbar = $request->input('check-navbar') !== null ? 1 : 0;
        $published = $request->input('check-publish') !== null ? 1 : 0;
        $homepage_id = $request->input('check-homepage') !== null ? $id : null;
        
        $page = Page::find($id);
        $page->title = $request->input('page-title');
        $page->url = $request->input('page-url');
        $page->navbar = $navbar;
        $page->published = $published;
        $page->save();
        
        $header = Header::where('page_id', $id)->first();
        $footer = Footer::where('page_id', $id)->first();
        $header->markup = $request->input('header-code');
        $footer->markup = $request->input('footer-code');
        $header->save();
        $footer->save();
        
        if ($homepage_id !== null)
        {
            $this->options['homepage_id'] = $homepage_id;
            $this->saveOptions();
        }
        
        return redirect()->action('AdminController@editPage', ['id' => $id]);
    }
    
    
    
    /**
     * POST methods
     */
    
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
    
    public function postGeneralOptions(Request $request)
    {
        $this->options['homepage_id'] = $request->input('homepage-id');
        $this->options['nav_brand'] = $request->input('nav-brand');
        
        if ($this->saveOptions())
        {
            $pages = Page::where('published', 1)->get();
            return view('admin.index', [
                'options' => $this->options,
                'pages' => $pages,
            ]);
        }
        else
        {
            die('There was a problem saving to the database');
        }
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
    
    
    
    /**
     * DELETE methods
     */
    
    
    
    
    
    

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
    public function destroy($type, $id)
    {
        switch ($type) {
            case 'page':
                $response = Page::destroy($id);
                break;
            case 'post':
                $response = Post::destroy($id);
                break;
            case 'user':
                $response = User::destroy($id);
                break;
            case 'footer':
                $response = Footer::destroy($id);
                break;
            case 'header':
                $response = Header::destroy($id);
                break;
            default:
                break;
        }
        
        return json_encode($response);
    }
}
