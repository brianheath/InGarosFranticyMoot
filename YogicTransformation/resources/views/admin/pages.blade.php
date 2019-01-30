@extends('layouts.admin')

@section('title', 'Admin - Pages')

@section('content')

<h2>Pages</h2>

<nav class="nav nav-tabs" style="margin-top: 30px; margin-bottom: 30px;">
    <a class="nav-link nav-item active" data-toggle="tab" role="tab" href="#page_list">Current Pages</a>
    <a class="nav-link nav-item" data-toggle="tab" role="tab" href="#add_page">Add a New Page</a>
</nav>


<div class="tab-content">
    <div class="tab-pane fade" role="tabpanel" id="add_page">
        <form id="new_page" action="{{ url('admin/addpage') }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label for="page_title">Title of the page</label>
                <input class="form-control" name="page-title" id="page_title" placeholder="This is what you see on your browser tab" />
            </div>

            <div class="form-group">
                <label for="page_url">URL to access the page</label>
                <input class="form-control" name="page-url" id="page_url" placeholder="This is what you see in the address bar" />
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="check-navbar" id="check_navbar" />
                <label for="check_navbar">Show Navigation Bar</label>
            </div>

            <div class="form-group">
                <label for="header_code">Header Code</label>
                <textarea class="form-control" name="header-code" id="header_code" rows="4"></textarea>
                <small class="form-text text-muted">Leave blank for no header on this page.&nbsp; You can edit this later.</small>
            </div>

            <div class="form-group">
                <label for="footer_code">Footer Code</label>
                <textarea class="form-control" name="footer-code" id="footer_code" rows="4"></textarea>
                <small class="form-text text-muted">Leave blank for no footer on this page.&nbsp; You can edit this later.</small>
            </div>
            
            <div class="form-group">
                <label for="footer_code">CSS</label>
                <textarea class="form-control code-box" name="page-css" id="page_css" rows="6"></textarea>
                <small class="form-text text-muted">Change the CSS for this page only.&nbsp; You can edit this later.</small>
            </div>

            <button type="submit" class="btn btn-primary">Add this page</button>
        </form>
    </div>
    
    <div class="tab-pane fade show active" role="tabpanel" id="page_list">
        <table class="table table-hover pages">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Created</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @foreach ($pages as $page)
                <tr id="item_{{ $page['id'] }}_row">
                    <td id="item_{{ $page['id'] }}_title">{{ $page['title'] }}</td>
                    <td id="item_{{ $page['id'] }}_url">/{{ $page['url'] }}</td>
                    <td>{{ date('M jS, Y', strtotime($page['created_at'])) }}</td>
                    <td>{{ $page['published'] == 1 ? 'Published' : 'Not Published' }}</td>
                    <td item-id="{{ $page['id'] }}" item-type="page">
                        <i class="fas fa-eye" action="view" data-toggle="modal" data-target="#view_modal"></i>
                        <i class="fas fa-edit" action="edit"></i>
                        <i class="fas fa-trash-alt" action="delete"></i>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
        
</div>

<div class="modal fade" id="view_modal" role="dialog" tabindex="-1" style="">
    <div class="modal-dialog modal-lg modal-fluid" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <a type="button" class="close" data-dismiss="modal"><span>&times;</span></a>
            </div>
            <div class="modal-body" style="">
                <iframe scrollable="no"></iframe>
{{--
                <p>And there I was, standing there as naked as the day I was born.
                All I could think about was how I was going to get my next fix.</p>
--}}
            </div>
        </div>
    </div>
</div>

@endsection