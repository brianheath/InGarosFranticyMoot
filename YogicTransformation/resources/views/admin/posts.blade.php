@extends('layouts.admin')

@section('title', 'Admin - Posts')

@section('content')

<h2>Posts</h2>

<nav class="nav nav-tabs" style="margin-top: 30px; margin-bottom: 30px;">
    <a class="nav-link nav-item active" data-toggle="tab" role="tab" href="#post_list">Current Posts</a>
    <a class="nav-link nav-item" data-toggle="tab" role="tab" href="#add_post">Create</a>
</nav>

<div class="tab-content">
    <div class="tab-pane fade" role="tabpanel" id="add_post">
        <form id="new_post" action="{{ url('admin/addpost') }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label for="post_title">Title of the post</label>
                <input class="form-control" name="post-title" id="post_title" placeholder="This is heading above the post" />
            </div>

            <div class="form-group">
                <label for="post_body">The post body <small class="text-muted" style="margin-left: 10px;">(HTML is allowed)</small></label>
                <textarea class="form-control" name="post-body" id="post_body" rows="20"></textarea>
            </div>

            <div class="form-group">
                <div class="dropdown add-post-dropdown">
                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                        Select the page for the post
                    </button>
                    <small class="form-text text-muted">Posts will be shown in ascending order by date</small>
                    <div class="dropdown-menu">
                        @foreach ($pages as $page)
                        <a class="dropdown-item" href="#" page="{{ $page['id'] }}">"{{ $page['title'] }}"</a>
                        @endforeach
                    </div>
                </div>
                <input type="hidden" name="parent-page-id" />
            </div>


            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="check-show-author" id="check_show_author" />
                <label for="check_show_author">Show the author</label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="check-show-date" id="check_show_date" />
                <label for="check_show_date">Show the date it was written</label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="check-publish" id="check_publish" />
                <label for="check_publish">Publish this post</label>
            </div>
            
            <div class="container-fluid" style="margin-top: 30px;">
                <div class="row">
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary">Add this post</button>
                    </div>
                    <div class="col-sm-2" style="text-align: right;">
                        <button type="button" class="btn btn-primary preview-post" data-toggle="modal" data-target="#preview_post">
                            <i class="fas fa-eye"></i> Preview Post
                        </button>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
    
    <div class="tab-pane fade show active" role="tabpanel" id="post_list">
        <table class="table table-hover posts">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Page</th>
                    <th>Author</th>
                    <th>Date Written</th>
                    <th>Last Updated</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @foreach ($posts as $post)
                <tr id="item_{{ $post['id'] }}_row">
                    <td id="item_{{ $post['id'] }}_title">{{ $post['title'] }}</td>
                    <td>{{ $post->page['title'] }}</td>
                    <td id="item_{{ $post['id'] }}_author">{{ $post->user['name'] }}</td>
                    <td id="item_{{ $post['id'] }}_date">{{ date('M jS, Y', strtotime($post['created_at'])) }}</td>
                    <td>{{ $post['updated_at'] ? date('M jS, Y', strtotime($post['updated_at'])) : '--' }}</td>
                    <td>{{ $post['published'] == 1 ? 'Published' : 'Not Published' }}</td>
                    <td item-id="{{ $post['id'] }}" item-type="post">
                        <i class="fas fa-eye" action="view" data-toggle="modal" data-target="#preview_post"></i>
                        <i class="fas fa-edit" action="edit"></i>
                        <i class="fas fa-trash-alt" action="delete"></i>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
        
</div>

<div class="modal fade" id="preview_post" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Post</h5>
                <a type="button" class="close" data-dismiss="modal"><span>&times;</span></a>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h1></h1>
                    <h4></h4>
                    <h5></h5>
                    <div class="body"></div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection