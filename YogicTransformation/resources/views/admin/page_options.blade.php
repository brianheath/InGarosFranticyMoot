@extends('layouts.admin')

@section('title', 'Admin - Page Options')

@section('content')

<h2>Components</h2>

<form id="pageOptions" action="{{ url('admin/page-options') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <input type="checkbox" id="check_navbar" name="checkNavBar" {{ $options['navbar'] ? 'checked' : '' }} />
        <label for="check_navbar">Include Navigation Bar</label>
        <textarea class="form-control" name="navbarCode" rows="6">@include('components.navbar')</textarea>
    </div>

    <div class="form-group">
        <input type="checkbox" id="check_header" name="checkHeader" {{ $options['header'] ? 'checked' : '' }} />
        <label for="check_header">Include Header</label>
        <textarea class="form-control" name="headerCode" rows="6">@include('components.header')</textarea>
    </div>

    <div class="form-group">
        <input type="checkbox" id="check_footer" name="checkFooter" {{ $options['footer'] ? 'checked' : '' }} />
        <label for="check_footer">Include Footer</label>
        <textarea class="form-control" name="footerCode" rows="6">@include('components.footer')</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
    
@endsection