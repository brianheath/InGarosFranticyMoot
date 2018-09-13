@extends('layouts.admin')

@section('title', 'Admin')

@section('content')
<div class="container-fluid">
    <div class="row _no-gutters">
        <div style="width: 200px;" class="col-sm-auto">
            <nav class="navbar flex-column">
                <a class="nav-link" href="">General&nbsp;Options</a>
                <a class="nav-link" href="#">Page Options</a>
                <a class="nav-link" href="#">About Info</a>
                <a class="nav-link" href="#">Other Stuff</a>
                <a class="nav-link" href="#">Things to Add</a>
            </nav>
        </div>

        <div style="padding: 25px;" class="col-sm">
            <h2>General Options</h2>
            
            <form style="margin: 20px 0 20px 0;">
                <div class="form-group">
                    <label for="weburl">This site's domain name</label>
                    <input class="form-control" id="weburl" placeholder="eg: subdomain.yourdomain.com" value="{{$options['site_url']}}">
                </div>
                <div class="form-group">
                    <label for="webname">Website Name</label>
                    <input class="form-control" id="webname" placeholder="Your website's name" value="{{$options['site_name']}}">
                </div>
                <div class="form-group">
                    <label for="tagline">Tagline</label>
                    <input class="form-control" id="tagline" placeholder="Enter the tag line of the website, or leave blank" value="{{$options['tag_line']}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
            
            
            <form>
                <div class="form-group">
                    <input type="checkbox" class="_form-check-input" id="checkNavBar" />
                    <label for="checkNavBar">Include Navigation Bar</label>
                    <textarea class="form-control" rows="6">@include('components.navbar')</textarea>
                </div>
                <button type="button" class="btn btn-primary">Update</button>
            </form>
        <!--    <form>
                    <textarea class="form-control" rows="6">@include('components.header')</textarea>
                    <textarea class="form-control" rows="6">@include('components.footer')</textarea>
                </div>
            </form>-->
        </div>
    </div>
    
</div>
@endsection