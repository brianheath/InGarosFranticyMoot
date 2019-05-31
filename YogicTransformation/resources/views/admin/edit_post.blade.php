@extends('layouts.admin')

@section('title', 'Admin - Edit Post')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <h2>Edit Post</h2>
        </div>
    </div>
</div>

<hr>

<form action="{{ url('/admin/post/'.$post['id']) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    
    <input type="hidden" name="post-id" value="{{ $post->id }}" />
    <div class="form-group">
        <label>Title</label>
        <input class="form-control" id="post_title" name="post-title" value="{{ $post->title }}" />
    </div>
    
    <div class="form-group">
        <label>Author</label>
        <input class="form-control" id="post_author" name="post-author" value="{{ $post['author']['name'] }}" readonly />
    </div>
    
    
    <div class="form-group">
        <label>Shown on page</label>
        <div class="dropdown post-page">
            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                Select page
            </button>
            <small class="form-text text-muted">All pages are shown regardless of published state.</small>
            <div class="dropdown-menu">
                @foreach ($post['pages'] as $page)
                <a class="dropdown-item" href="#" item-id="{{ $page['id'] }}">"{{ $page['title'] }}"</a>
                @endforeach
            </div>
        </div>
        <input type="hidden" name="dropdown-value" value="{{ $post['page_id'] }}" />
    </div>

    
    <div class="form-group">
        <i class="fas fa-caret-down"></i>
        <label class="toggle-code" data-target="#post_body">Body</label>
        <textarea class="form-control code-box" id="post_body" name="post-body" rows="20">{{ $post->body }}</textarea>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="post-showauthor" id="post_show_author" {{ $post['show_author'] ? 'checked' : '' }} />
        <label for="post_show_author">Show the author</label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="post-showdate" id="post_show_date" {{ $post['show_date'] ? 'checked' : '' }} />
        <label for="post_show_date">Show the date it was written</label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="post-publish" id="post_publish" {{ $post['published'] ? 'checked' : '' }} />
        <label for="post_publish">Publish this post</label>
    </div>
    
    <div class="form-group">
    </div>
        
    <div class="form-group">
        <span style="font-size: 1.1rem;">Date created:</span>
        <span style="font-size: .9rem;">
            {{ date('M j, Y @ H:i', strtotime($post->created_at)) }}
        </span>
        <br>
        <span style="font-size: 1.1rem;">Date of last update:</span>
        <span style="font-size: .9rem;">
            {{ date('M j, Y @ H:i', strtotime($post->updated_at)) }}
        </span>
        <br>
        <small class="form-text text-muted">All times are GMT</small>
    </div>
    
    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row">
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>

</form>

@endsection