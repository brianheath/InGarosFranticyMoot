@extends('layouts.admin')

@section('title', 'Admin - Pages')

@section('content')

<h2>Pages</h2>

<p>&nbsp;</p>
<h4>Add a new page</h4>

<form id="new_page" action="{{ url('admin/addpage') }}" method="post">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <div class="form-group">
        <label for="page_title">Title</label>
        <input class="form-control" name="page-title" id="page_title" placeholder="This is what you see on your browser tab" />
    </div>

    <div class="form-group">
        <label for="page_url">URL</label>
        <input class="form-control" name="page-url" id="page_url" placeholder="This is what you see in the address bar" />
    </div>

    <h5>Include:</h5>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="check-navbar" id="check_navbar" />
        <label for="check_navbar">Navigation Bar</label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="check-header" id="check_header" />
        <label for="check_header">Header</label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="check-footer" id="check_footer" />
        <label for="check_footer">Footer</label>
    </div>

    <button type="submit" class="btn btn-primary">Add this page</button>
</form>

<p>&nbsp;</p>
<p>&nbsp;</p>
<h4>Current Pages</h4>
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
        <tr>
            <td>{{ $page['title'] }}</td>
            <td>/{{ $page['url'] }}</td>
            <td>{{ $page['created_at'] }}</td>
            <td>{{ $page['enabled'] == 1 ? 'Published' : 'Not Published' }}</td>
            <td><i class="fas fa-eye"></i> <i class="fas fa-edit"></i> <i class="fas fa-trash-alt"></i></td>
        </tr>
    @endforeach
</table>

@endsection