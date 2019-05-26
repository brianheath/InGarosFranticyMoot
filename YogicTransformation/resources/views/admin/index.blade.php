@extends('layouts.admin')

@section('title', 'Admin - General Options')

@section('content')

<h2>General Options</h2>

<form style="margin: 20px 0 20px 0;" action="{{ url('admin/general-options') }}" method="post">
    {{ csrf_field() }}

    <div class="form-group" style="margin-top: 40px;">
        <label>Select Homepage</label>
        <div class="dropdown homepage-dropdown">
            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                Select the default (home) page
            </button>
            <small class="form-text text-muted">The homepage will be shown regardless of the page's Published status</small>
            <div class="dropdown-menu">
                @foreach ($pages as $page)
                <a class="dropdown-item" href="#" item-id="{{ $page['id'] }}">"{{ $page['title'] }}"</a>
                @endforeach
            </div>
        </div>
        <input type="hidden" name="dropdown-value" value="{{ $options['homepage_id'] }}" />
    </div>

    <div class="form-group" style="margin-top: 40px;">
        <label for="nav_brand">Navigation Bar Brand</label>
        <input class="form-control" name="nav-brand" id="nav_brand" placeholder="Enter text or image tag" value="{{ $options['nav_brand'] }}" />
        <small class="form-text text-muted">This can be a text or image that is shown on the nav bar.</small>
    </div>

    <div class="form-group form-check" style="margin-top: 40px;">
        <input type="checkbox" class="form-check-input" name="full-width" id="full_width" {{ $options['full_width'] ? 'checked' : '' }} />
        <label for="full_width">Enable full width</label>
        <small class="form-text text-muted">Unchecking this will center all content on the page.&nbsp; This does not apply to admin pages.</small>
    </div>

    <div class="form-group form-check" style="margin-top: 40px;">
        <input type="checkbox" class="form-check-input" name="allow-register" id="allow_register" {{ $options['allow_register'] ? 'checked' : '' }} />
        <label for="allow_register">Allow users to Register</label>
        <small class="form-text text-muted">If checked, any user can register an account.&nbsp; Otherwise, new users are set up via Admin.</small>
    </div>

    <button type="submit" class="btn btn-primary" style="margin-top: 40px;">Save Options</button>
</form>

@endsection