<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Auth;

//use App\Http\Requests;
use App\Footer;
use App\Header;
use App\Page;
use App\Post;
use App\User;

class AdminController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        
//        $this->middleware('auth');
    }
    
    public function getRarr()
    {
//        $role = Role::create([
//            'name' => 'Customer',
//            'slug' => 'customer',
//            'description' => 'Paying Customer',
//            'level' => 2,
//        ]);
//        return $role;
        
//        $user = User::find(1);
//        $user->attachRole(2);
//        return $user->roles;
        
//        return Auth::user()->is('admin') ? "Yeah, yay!" : "Nooooooooooope.";
//        return Auth::user()->isAdmin() ? "Yeah, yay!" : "Nooooooooooope.";
//        return auth()->user()->id;
        return Auth::user() ? "YEPPPERSSS" : "Aww crap.";
    }
    
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
        return view('admin.users', [
            'users' => User::all(),
            'roles' => Role::all(),
        ]);
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
    
    public function editUser($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        
        return view('admin.edit_user', [
            'user' => $user,
            'roles' => $roles,
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
        $post->user_id = auth()->user()->id;
        $post->show_date = $show_date;
        $post->show_author = $show_author;
        $post->published = $published;
        $post->save();
        
        return redirect()->action('AdminController@getPosts');
    }
    
    public function putAdduser(Request $request)
    {
        // TODO: Add validation
        
        $user = User::create([
            'name' => $request->input('user-name'),
            'email' => $request->input('user-email'),
            'password' => bcrypt($request->input('user-password')),
        ]);
        
        $user->attachRole($request->input('user-role-id'));
        
        return redirect()->back();
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
    
    public function updateUser(Request $request)
    {
        $user = User::find($request->input('user-id'));
        $user->name = $request->input('user-name');
        $user->email = $request->input('user-email');
        $user->save();
        
        $role_ids = array_filter(explode(",", $request->input('role-ids')), 'strlen');
        $user->detachAllRoles();
        
        foreach ($role_ids as $role_id) {
            $user->attachRole($role_id);
        }
        
        return redirect()->action('AdminController@getUsers');
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
        $this->options['full_width'] = $request->input('full-width') !== null ? 1 : 0;
        $this->options['allow_register'] = $request->input('allow-register') !== null ? 1 : 0;
        
        if ($this->saveOptions())
        {
            return redirect()->back();
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
     * Remove the specified resource from storage.
     *
     * @param  string  $type
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

}
