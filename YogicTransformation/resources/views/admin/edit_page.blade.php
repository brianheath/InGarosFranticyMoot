@extends('layouts.admin')

@section('title', 'Admin - Edit Page')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <h2>Edit Page</h2>
        </div>
        <div class="col-sm-2" style="text-align: right;">
            <button type="button" class="btn btn-primary preview-page" data-toggle="modal" data-target="#preview_page_update">
                <i class="fas fa-eye"></i> Preview Page
            </button>
        </div>
    </div>
</div>

<hr>

<form action="{{ url('/admin/page/'.$page['id']) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    
    <div class="form-group">
        <h5>Header</h5>
        <div id="header_output" style="border: 1px solid #ddd; margin-bottom: 20px;">
            {!! $page->header['markup'] !!}
        </div>

        <i class="fas fa-caret-down"></i>
        <label class="toggle-code" data-target="#header_code">HTML Code</label>
        <textarea class="form-control code-box" id="header_code" name="header-code" rows="6">{{ $page->header['markup'] }}</textarea>
        
        <button type="button" class="btn btn-light" id="update_header">Refresh Header</button>
    </div>
    
    <div class="form-group" style="margin: 60px 0;">
        <h5>Footer</h5>
        <div id="footer_output" style="border: 1px solid #ddd; margin-bottom: 20px;">
            {!! $page->footer['markup'] !!}
        </div>

        <i class="fas fa-caret-down"></i>
        <label class="toggle-code" data-target="#footer_code">HTML Code</label>
        <textarea class="form-control code-box" id="footer_code" name="footer-code" rows="6">{{ $page->footer['markup'] }}</textarea>
        
        <button type="button" class="btn btn-light" id="update_footer">Refresh Footer</button>
    </div>

    <div class="form-group" style="margin: 60px 0;">
        <h5>Head data</h5>
        <textarea class="form-control code-box" id="page_head" name="page-head" rows="6">{{ $page['head'] }}</textarea>
    </div>

    <div class="form-group" style="margin: 60px 0;">
        <h5>CSS</h5>
        <i class="fas fa-caret-down"></i>
        <label class="toggle-code" data-target="#page_css">HTML Code</label>
        <textarea class="form-control code-box" id="page_css" name="page-css" rows="6">{{ $page['css'] }}</textarea>
    </div>

    <h5>Other Options</h5>
    <div class="form-group">
        <label for="page_title">Title of the page</label>
        <input class="form-control" name="page-title" id="page_title" value="{{ $page['title'] }}" />
    </div>
    
    <div class="form-group" style="margin-bottom: 0;">
        <label for="page_url">URL to access the page</label>
    </div>
    <div class="input-group" style="margin-bottom: 1rem;">
        <div class="input-group-prepend">
            <span class="input-group-text">/</span>
        </div>
        <input type="text" class="form-control" name="page-url" id="page_url" value="{{ $page['url'] }}" autocomplete="new-password" />
    </div>
    
    <div class="form-check" style="margin-top: 20px;">
        <input type="checkbox" class="form-check-input" name="check-navbar" id="check_navbar" {{ $page['navbar'] ? 'checked' : '' }} />
        <label for="check_navbar">Enable the Navigation Bar</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="check-publish" id="check_publish" {{ $page['published'] ? 'checked' : '' }} />
        <label for="check_publish">Publish this page</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="check-homepage" id="check_homepage" {{ $page['is_homepage'] ? 'checked disabled' : '' }} />
        <label for="check_homepage">Set this as the Homepage</label>
        
        @if ($page['is_homepage'])
        <small class="form-text text-muted">The site requires a homepage.&nbsp; Edit another page or visit General Options to change this.</small>
        @endif
    </div>
    
    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row">
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Save Page Changes</button>
            </div>
            <div class="col-sm-2" style="text-align: right;">
                <button type="button" class="btn btn-primary preview-page" data-toggle="modal" data-target="#preview_page_update">
                    <i class="fas fa-eye"></i> Preview Page
                </button>
            </div>
        </div>
    </div>

</form>



<div class="modal fade" id="preview_page_update" role="dialog" tabindex="-1" style="">
    <div class="modal-dialog modal-lg modal-fluid" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <a type="button" class="close" data-dismiss="modal"><span>&times;</span></a>
            </div>
            <div class="modal-navbar">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" style="cursor: default;">{{ $options['nav_brand'] }}</a>
                    <div class="navbar-nav">
                        <a class="nav-item nav-link">Home</a>

                        @foreach ($links as $link)
                        <a class="nav-item nav-link">{{ $link['title'] }}</a>
                        @endforeach

                    </div>
                </nav>
            </div>
            <div class="modal-body">
                <iframe></iframe>
            </div>
        </div>
    </div>
</div>


@endsection