@extends('layouts.admin')

@section('title', 'Admin - Site Config')

@section('content')

<h2>Site Configuration</h2>

<form style="margin: 20px 0 20px 0;" action="{{ url('admin/site-config') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="site_url">This site's domain name</label>
        <input class="form-control" name="site-url" id="site_url" placeholder="eg: subdomain.yourdomain.com" value="{{ $options['site_url'] }}">
    </div>
    <div class="form-group">
        <label for="site_name">Website Name</label>
        <input class="form-control" name="site-name" id="site_name" placeholder="Your website's name" value="{{ $options['site_name'] }}">
    </div>
    <div class="form-group">
        <label for="site_tagline">Tagline</label>
        <input class="form-control" name="site-tagline" id="site_tagline" placeholder="Enter the tagline of the website, or leave blank" value="{{ $options['site_tagline'] }}">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection