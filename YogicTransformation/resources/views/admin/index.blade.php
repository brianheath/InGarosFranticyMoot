@extends('layouts.admin')

@section('title', 'Admin - General Options')

@section('content')

<h2>General Options</h2>

<h5>Homepage</h5>
<div class="dropdown">
    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
        Select the default (home) page
    </button>
    <small class="form-text text-muted">The home page will be shown regardless of its Published status</small>
    <div class="dropdown-menu">
        @foreach ($pages as $page)
        <a class="dropdown-item" href="#" page="{{ $page['id'] }}">"{{ $page['title'] }}"</a>
        @endforeach
    </div>
</div>

<form style="margin: 20px 0 20px 0;" action="{{ url('admin/general-options') }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="homepage-id" value="{{ $options['homepage_id'] }}" />
    <button type="submit" class="btn btn-primary">Save Options</button>
</form>

@endsection