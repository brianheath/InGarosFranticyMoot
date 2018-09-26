@extends('layouts.admin')

@section('title', 'Admin - General Options')

@section('content')

<h2>General Options</h2>

<h6>Select Homepage</h6>
<div class="form-group">
    <div class="dropdown homepage-dropdown">
        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
            Select the default (home) page
        </button>
        <small class="form-text text-muted">The home page will be shown regardless of the page's Published status</small>
        <div class="dropdown-menu">
            @foreach ($pages as $page)
            <a class="dropdown-item" href="#" page="{{ $page['id'] }}">"{{ $page['title'] }}"</a>
            @endforeach
        </div>
    </div>
</div>

<form style="margin: 20px 0 20px 0;" action="{{ url('admin/general-options') }}" method="post">

    <div class="form-group" style="margin-top: 40px;">
        <label for="">Navigation Bar Brand</label>
        <input class="form-control" name="nav-brand" id="nav_brand" placeholder="Enter text or image tag" value="{{ $options['nav_brand'] }}" />
        <small class="form-text text-muted">This can be a text or image that is shown on the nav bar.</small>
    </div>


    {{ csrf_field() }}
    <input type="hidden" name="homepage-id" value="{{ $options['homepage_id'] }}" />
    <button type="submit" class="btn btn-primary">Save Options</button>
</form>

@endsection