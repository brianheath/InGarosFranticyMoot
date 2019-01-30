@extends('layouts.admin')

@section('title', 'Admin - Styling')

@section('content')

<h2>Styling</h2>

<form name="site-css" style="margin: 20px 0 20px 0;" action="{{ url('admin/edit_css') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Site-wide CSS</label>
        <textarea class="form-control code-box" rows="20" name="site-css" id="site_css" autofocus>{{ $css['css_body'] }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection